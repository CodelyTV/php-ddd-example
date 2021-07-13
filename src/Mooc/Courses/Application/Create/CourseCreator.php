<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Mooc\Courses\Domain\CourseNotifier;


final class CourseCreator
{
    public function __construct(private CourseRepository $repository, private EventBus $bus, private CourseNotifier $courseNotifier )
    {
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration): void
    {
        $course = Course::create($id, $name, $duration);
        $this->repository->save($course);
        $this->courseNotifier->publish("Course " . $name->value() . " published!");
        $this->bus->publish(...$course->pullDomainEvents());
    }

    /* Si volem que al crear un curs, s'envii una notificació/email/tweet, opcions:

       - Pasar el notifier desde el constructor. NOTA-> Només si volem que SEMPRE s'envii la notificació
         - PRO: Obliguem a que sempre que s'envii la notificació
         - CON: Violem el Principi de Responsabilitat Única ???
       - Crear un servei apart i que en la infraestructura, sempre que es crei un curs nou, cridar també al servei de notificacions
       	 - PRO: Respectem el PRS 
       	 - CON: Cal modificar el códi a tots els llocs que es crei un video nou i a mes a mes no estem obligats o no tenim contracte per a enviar la notificació cada vegada que es crea el curs. 
	   - Crear métode públic a on li passem la interface notifier de forma opcional, després en el _invoque, si se li ha passat la interface, enviar notificació, sino, no.
    */
}
