<?
namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'es'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back();
    }
}
