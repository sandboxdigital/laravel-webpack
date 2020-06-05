<?php

namespace Sandbox\Webpack\Middleware;

use Closure;
use Sandbox\Webpack\Webpack;
use Illuminate\Http\Response;

class WebpackMiddleware
{
    public function handle($request, Closure $next)
    {
        if($request->get('disableWebpack')) {
            Webpack::setHot(false);
            session()->forget('webpackEnabled');
        } else {
            // Check session -
            $webpack = session()->get('webpackEnabled');

            if ($webpack) {
                Webpack::setHot(true);
            } else if ($request->get('enableWebpack')) {
                Webpack::setHot(true);
                session()->put('webpackEnabled', true);
            }
        }
        //dd($webpack);

        $response = $next($request);

        $type = $response->headers->get('Content-Type','');
        if ($response instanceof Response
            && str_contains($type, 'text/html')) {

            $hot = Webpack::isHot() ? 'true' : 'false';

            $jsPath = '/webpack-asset.js';
            $cssPath = '/webpack-asset.css';

            //$jsPath = 'http://localhost:8080/assets/combined/webpack.js';
            //$cssPath = 'http://localhost:8080/assets/combined/webpack.css';

            $html = '<div id="webpack-switcher" data-hot="'.$hot.'">
<div :class="status">
    <div class="webpack-hot-enabled"><span class="hot-enabled">HOT</span> <button class="btn-webpack-disable">disable</button></div>
    <div class="webpack-hot-disabled"><span class="hot-disabled">NOT HOT</span> <button class="btn-webpack-enable">enable</button></div>
</div>
</div>';

            $this->insertBefore($response, '</body>', $html);
            $this->insertBefore($response, '</html>', '<script src="'.$jsPath.'" type="text/javascript"></script> <link href="'.$cssPath.'" rel="stylesheet">');
        }

        //dd($response);

        return $response;
    }

    /**
     * @param Response $response
     * @param string $stringToFind
     * @param string $textToInsert
     */
    private function insertBefore(Response $response, $stringToFind, $textToInsert)
    {
        $content = $response->getContent();

        if (($html = mb_strpos($content, $stringToFind)) !== false) {
            $response->setContent(mb_substr($content, 0, $html) . $textToInsert .  mb_substr($content, $html));
        }
    }
}
