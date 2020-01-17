<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Backoffice\Frontend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class CoursesPostWebController extends WebController
{
    public function __invoke(Request $request)
    {
        $validationErrors = $this->validateRequest($request);

        return $validationErrors->count()
            ? $this->redirectWithErrors('courses_get', $validationErrors, $request)
            : $this->createCourse($request);
    }

    private function validateRequest(Request $request): ConstraintViolationListInterface
    {
        $constraint = new Assert\Collection(
            [
                'id'       => new Assert\Uuid(),
                'name'     => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
                'duration' => [new Assert\NotBlank(), new Assert\Length(['min' => 4, 'max' => 100])],
            ]
        );

        $input = $request->request->all();

        return Validation::createValidator()->validate($input, $constraint);
    }

    private function createCourse(Request $request): RedirectResponse
    {
        $this->dispatch(
            new CreateCourseCommand(
                $request->request->get('id'),
                $request->request->get('name'),
                $request->request->get('duration')
            )
        );

        return $this->redirectWithMessage(
            'courses_get',
            sprintf('Feliciades, el curso %s ha sido creado!', $request->request->get('name'))
        );
    }
}
