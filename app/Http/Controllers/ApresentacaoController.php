<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ApresentacaoController extends Controller
{
    public function index()
    {
        $domPDF = Pdf::loadHTML('<h1 style="color:royalblue;text-align:center;">Gerador de PDF - DOMPDF</h1>');

        return $domPDF->stream();
    }

    public function cursos(Request $request)
    {
        $cursos = [
            'PHP' => [
                'nome' => 'Cursos de PHP',
                'versao' => 'PHP 8.0'
            ],
            'React' => [
                'nome' => 'Curso de React',
                'versao' => '18'
            ]
        ];

        $domPDF = PDF::loadView('cursos', compact('cursos'));

        return $domPDF->setPaper($request['size'] ?? 'a3', $request['orientation'] ?? 'portrait') // landscape and portrait
                ->save(public_path() . '/cursos.pdf')
                ->stream('cursos.pdf');
    }

    public function pagePDF()
    {
        $domPDF = PDF::loadFile(public_path() . '/page-cursos-pdf.html');

        return $domPDF->stream();
    }
}
