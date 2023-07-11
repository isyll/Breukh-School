<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Classe
 *
 * @property int $id
 * @property string $name
 * @property int $grade_level_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \App\Models\GradeLevel $gradeLevel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereGradeLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperClasse {}
}

namespace App\Models{
/**
 * App\Models\ClasseSubject
 *
 * @property int $id
 * @property int $classe_id
 * @property int $subject_id
 * @property int $school_year_id
 * @property int $max_note
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject whereMaxNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject whereSchoolYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseSubject whereSubjectId($value)
 * @mixin \Eloquent
 */
	class IdeHelperClasseSubject {}
}

namespace App\Models{
/**
 * App\Models\Cycle
 *
 * @property int $id
 * @property string $name
 * @property int $number
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereNumber($value)
 * @mixin \Eloquent
 */
	class IdeHelperCycle {}
}

namespace App\Models{
/**
 * App\Models\Enrollment
 *
 * @property int $id
 * @property int $student_id
 * @property int $classe_id
 * @property int $school_year_id
 * @property string $date
 * @property-read \App\Models\Classe $classe
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\SchoolYear|null $year
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment whereSchoolYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enrollment whereStudentId($value)
 * @mixin \Eloquent
 */
	class IdeHelperEnrollment {}
}

namespace App\Models{
/**
 * App\Models\Evaluation
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperEvaluation {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $date
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperEvent {}
}

namespace App\Models{
/**
 * App\Models\GradeLevel
 *
 * @property int $id
 * @property string $name
 * @property int $cycle_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Classe> $classes
 * @property-read int|null $classes_count
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereCycleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperGradeLevel {}
}

namespace App\Models{
/**
 * App\Models\Note
 *
 * @property int $id
 * @property int $enrollment_id
 * @property int $classe_subject_id
 * @property int $evaluation_id
 * @property int $cycle
 * @property float $value
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereClasseSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCycle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereEnrollmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereEvaluationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereValue($value)
 * @mixin \Eloquent
 */
	class IdeHelperNote {}
}

namespace App\Models{
/**
 * App\Models\Param
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|Param newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Param newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Param query()
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereValue($value)
 * @mixin \Eloquent
 */
	class IdeHelperParam {}
}

namespace App\Models{
/**
 * App\Models\SchoolYear
 *
 * @property int $id
 * @property int $state
 * @property string $period
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear whereState($value)
 * @mixin \Eloquent
 */
	class IdeHelperSchoolYear {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string|null $birthdate
 * @property string|null $birthplace
 * @property string|null $gender
 * @property string $profile
 * @property int $state
 * @property int|null $number
 * @property int $parent_id
 * @property-read \App\Models\Enrollment|null $enrollments
 * @property-read \App\Models\StudentParent $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereState($value)
 * @mixin \Eloquent
 */
	class IdeHelperStudent {}
}

namespace App\Models{
/**
 * App\Models\StudentParent
 *
 * @property int $id
 * @property string $email
 * @method static \Illuminate\Database\Eloquent\Builder|StudentParent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentParent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentParent query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentParent whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentParent whereId($value)
 * @mixin \Eloquent
 */
	class IdeHelperStudentParent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property int|null $subject_group_id
 * @property string $name
 * @property string $code
 * @property-read \App\Models\SubjectGroup|null $group
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSubjectGroupId($value)
 * @mixin \Eloquent
 */
	class IdeHelperSubject {}
}

namespace App\Models{
/**
 * App\Models\SubjectGroup
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectGroup whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperSubjectGroup {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

