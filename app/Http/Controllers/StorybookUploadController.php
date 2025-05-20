<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Storybook;
use App\Models\Creators;
use App\Models\Pages;
use App\Models\Panels;
use App\Models\PanelsContent;

class StorybookUploadController extends Controller
{
    public function upload(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'storybook' => 'required|array',
            'pages' => 'required|array',
            'background_image' => 'nullable|string',
            'storybook_profile' => 'nullable|string',
        ]);

        $storybookData = $data['storybook'];
        $pagesData = $data['pages'];
        $backgroundImage = $data['background_image'] ?? null;
        $profileImage = $data['storybook_profile'] ?? null;

        // Calculate total words in all panels
        $totalWords = 0;
        foreach ($pagesData as $page) {
            foreach ($page['panels']['panels_content'] as $panel) {
                foreach (['top_text', 'middle_text', 'bottom_text'] as $field) {
                    if (!empty($panel[$field])) {
                        $totalWords += str_word_count($panel[$field]);
                    }
                }
            }
        }
        $pagesNumber = count($pagesData);
        $readTime = max(1, ceil($totalWords / 150) + ceil($pagesNumber * 0.5));

        DB::beginTransaction();
        try {
            // Create Storybook
            $storybook = Storybook::create([
                'title' => $storybookData['title'],
                'description' => $storybookData['description'],
                'storybook_words' => $totalWords,
                'read_time' => $readTime,
                'read_count' => 0,
                'pages_number' => $pagesNumber,
                'is_approved' => 0,
                'id_language' => 0, // default
                'background_image' => $backgroundImage,
                'storybook_profile' => $profileImage,
            ]);

            // Link Creator
            Creators::create([
                'id_user' => $user->id,
                'id_storybook' => $storybook->id,
            ]);

            // Create Pages, Panels, PanelsContent
            foreach ($pagesData as $pageIdx => $page) {
                $pageModel = Pages::create([
                    'storybook_id' => $storybook->id,
                    'page_information' => $pageIdx + 1,
                ]);
                $panelsModel = Panels::create([
                    'id_pages' => $pageModel->id,
                    'panels_number' => count($page['panels']['panels_content']),
                ]);
                foreach ($page['panels']['panels_content'] as $panelContent) {
                    PanelsContent::create([
                        'id_panels' => $panelsModel->id,
                        'image' => $panelContent['image'] ?? null,
                        'top_text' => $panelContent['top_text'] ?? '',
                        'top_text_align' => $panelContent['top_text_align'] ?? '',
                        'middle_text' => $panelContent['middle_text'] ?? '',
                        'middle_text_align' => $panelContent['middle_text_align'] ?? '',
                        'bottom_text' => $panelContent['bottom_text'] ?? '',
                        'bottom_text_align' => $panelContent['bottom_text_align'] ?? '',
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Storybook uploaded successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
