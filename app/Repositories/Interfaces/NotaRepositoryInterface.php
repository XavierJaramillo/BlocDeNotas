<?php
namespace App\Repositories\Interfaces;

Interface NotaRepositoryInterface
{
    public function searchNotas(string|null $where, int $inicio, int $limit = 6):array;
}