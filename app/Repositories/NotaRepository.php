<?php

namespace App\Repositories;

use App\Models\Nota;
use App\Repositories\Interfaces\NotaRepositoryInterface;

class NotaRepository implements NotaRepositoryInterface
{
    public function searchNotas($where, $inicio, $limit = 6):array
    {
        $notas = new Nota;

        if($where) {
            $notas = $notas->where('titulo', 'like', "%$where%")
                ->orWhere('cuerpo', 'like', "%$where%");
        }

        $notas = $notas->offset($inicio)
            ->limit(6)
            ->get();

        $notaCount = Nota::count();
        if($where) {
            $notaCount = count($notas);
        }

        return [
            'notas' => $notas,
            'notaCount' => $notaCount,
            'limit' => $limit
        ]; 
    }
}