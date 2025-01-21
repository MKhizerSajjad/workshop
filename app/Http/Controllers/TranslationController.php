<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TranslationController extends Controller
{


    public function index(Request $request)
    {
        $language = $request->input('lang', 'en');
        $languages = ['en', 'es', 'fr'];

        $keys = Translation::distinct()->pluck('key');

        $translations = [];
        if ($language) {
            $translations = Translation::where('language', $language)->pluck('value', 'key')->toArray();
        }

        return view('translations.index', compact('keys', 'translations', 'languages'));
    }

    public function updateMultiple(Request $request)
    {
        $language = $request->input('language');
        $values = $request->input('values');
        $keys = $request->input('keys');

        foreach ($keys as $key) {
            $value = $values[$key] ?? null;

            if ($value) {
                // Update or create a translation for the key and language
                Translation::updateOrCreate(
                    ['key' => $key, 'language' => $language],
                    ['value' => $value]
                );
            }
        }

        return redirect()->route('translations.index')->with('success', 'Translations updated successfully.');
    }

    public function store(Request $request)
    {
        $slugifiedKey = Str::slug($request->key);
        $request->merge(['key' => $slugifiedKey]);

        $request->validate([
            'key' => 'required|string|unique:translations,key,NULL,id,language,' . $request->language,
            'language' => 'required|string',
            'value' => 'required|string',
        ], [
            'key.required' => 'The translation key is required.',
            'language.required' => 'The language is required.',
            'value.required' => 'The translation value is required.',
            'key.unique' => 'A translation with this key and language already exists.',
        ]);

        Translation::updateOrCreate(
            ['key' => $slugifiedKey, 'language' => $request->language],
            ['value' => $request->value]
        );

        return redirect()->route('translations')->with('success', 'Translation saved successfully.');
    }

}
