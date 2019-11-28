<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/validate', function (\Illuminate\Http\Request $request) {
    $parole = strtolower('Ei fu Siccome immobile dato mortal sospiro stette spoglia immemore orba tanto spiro cosi percossa attonita terra nunzio sta muta pensando ultima ora uom fatale quando una simile orma pie mortale sua cruenta polvere calpestar Lui folgorante in solio vide il mio genio tacque quando con vece assidua cadde risorse e giacque mille voci al sonito mista non vergin servo encomio codardo oltraggio sorge or commosso al subito sparir tanto raggio scioglie all urna un cantico forse');
    $parole = explode(' ', $parole);
    $index = random_int(0, sizeof($parole)-3);
    $newWord =  $parole[$index] . '_' . $parole[$index+1] . '_' . $parole[$index+2];
    
    $word = \App\Word::latest()->firstOrFail();
    $word->increment('attempts');
    if($word->attempts > 5){
        sleep($word->attempts / 6);
    }

    if ($word && $request->password == $word->value) {
        $word->ip = $request->ip();
        $word->save();
        \App\Word::create([
            'value' => $newWord,
        ]);
        return response(['status' => 'ok', 'unlock' => 'valid'], 200);
    }
    return response(['status' => 'ko'], 403);
});

$router->get('/monitor', function (\Illuminate\Http\Request $request) {
    if ($request->auth !== 'dBKacly60aKb6AmRGMpO') {
        return 'Not authorized';
    }
    return view('monitor')->with(['words' => \App\Word::all()]);
});





/*
|--------------------------------------------------------------------------
| WH
|--------------------------------------------------------------------------
 */

use Illuminate\Http\Request;

Route::post('/wh', function (Request $request) {
    \App\Facebook::create([
        'payload' => $request->all(),
    ]);
    return 'ok';
});

Route::get('/wh', function (Request $request) {
    info($request->all());
    $challenge = $request->hub_challenge;
    info($challenge);
    return $challenge;
});

Route::get('/privacy', function (Request $request) {
    return '<html>
    <head>
        <title>privacy policy</title>
    </head>
    <body>
        <h1>Privacy</h1>
        A privacy policy is a statement or a legal document (in privacy law) that discloses some or all of the ways a party gathers, uses, discloses, and manages a customer or client\'s data. ... Their privacy laws apply not only to government operations but also to private enterprises and commercial transactions.
    </body>
    </html>';
});
