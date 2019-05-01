<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/validate', function (\Illuminate\Http\Request $request) {
    // $parole = strtolower('Ei fu Siccome immobile dato mortal sospiro stette spoglia immemore orba tanto spiro cosi percossa attonita terra nunzio sta muta pensando ultima ora uom fatale quando una simile orma pie mortale sua cruenta polvere calpestar Lui folgorante in solio vide il mio genio tacque quando con vece assidua cadde risorse e giacque mille voci al sonito mista non vergin servo encomio codardo oltraggio sorge or commosso al subito sparir tanto raggio scioglie all urna un cantico forse');
    // $parole = explode(' ', $parole);
    // $index = random_int(0, sizeof($parole)-3);
    // $newWord =  $parole[$index] . '_' . $parole[$index+1] . '_' . $parole[$index+2];
    
    $word = \App\Word::latest()->firstOrFail();
    $word->increment('attempts');
    // if($word->attempts > 5){
    //     // sleep($word->attempts / 6);
    // }

    if ($word && $request->password == $word->value) {
        // $word->ip = $request->ip();
        // $word->save();
        // \App\Word::create([
        //     'value' => $newWord,
        // ]);
        return response(['status' => 'ok', 'unlock' => 'valid'], 200);
    }
    return response(['status' => 'ko'], 403);
});
