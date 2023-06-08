<?php

namespace App\Controller;

use App\Entity\SudokuGrid;
use App\Form\SudokuType;
use App\Service\CsvService;
use App\Service\SudokuValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class SudokuController extends AbstractController
{
    #[Route('/', name: 'sudoku_home')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $validator = new SudokuValidationService();
        $form = $this->createForm(SudokuType::class, $validator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $csv = $form->get('sudoku')->getData();
            $grid = new SudokuGrid(
                (new CsvService())->parse($csv->openFile())->mapToInt()->get()
            );

            $validator->setGrid($grid);

            $result = $validator->validate() ? 1 : 0;
            $invalidCells = $validator->getInvalidCells();
            $sectionSide = $grid->sectionSide();
        }

        return $this->render('sudokuValidator.html.twig', [
            'form' => $form->createView(),
            'result' => $result ?? null,
            'grid' => $grid ?? null,
            'invalidCells' => $invalidCells ?? null,
            'sectionSide' => $sectionSide ?? null,
        ]);
    }
}
