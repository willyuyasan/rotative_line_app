<?php
 
namespace App\Filament\Pages;
 
class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Rotative-Line dashboard';
    protected static string $routePath = 'rotative-line';
    //protected static bool $isDiscovered = false; //use to refreshing witgets content
    
    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }

}
