<?php

namespace App\Providers;

use App\Mixins\BluePrintMixins;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Blueprint::mixin(new BluePrintMixins());

        Blade::directive('markdown', function () {
            return "<?php echo Illuminate\Mail\Markdown::parse(<<<HEREDOC";
        });

        Blade::directive('endmarkdown', function () {
            return 'HEREDOC); ?>';
        });

        FilamentAsset::register([
            Css::make('scrollbar', __DIR__.'/../../resources/css/scrollbar.css'),
        ]);
    }
}
