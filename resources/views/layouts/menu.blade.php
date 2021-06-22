<li class="nav-header">Menu Utama</li>
<li class="nav-item">
    <a href="{{ route('admin.home') }}" class="nav-link {{ Request::is('admin/home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p style="font-size: 18px;">
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('userStudents.index') }}"
        class="nav-link {{ Request::is('admin/userStudents*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p style="font-size: 18px;">Daftar Pengguna</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('modelHasRoles.index') }}"
        class="nav-link {{ Request::is('admin/modelHasRoles*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-briefcase"></i>
        <p>Manajement Pengguna</p>
    </a>
</li>

{{--
<li class="nav-item">
    <a href="{{ route('userTeachers.index') }}" class="nav-link
{{ Request::is('admin/userTeachers*') ? 'active' : '' }}">
<i class="nav-icon fas fa-graduation-cap"></i>
<p style="font-size: 18px;">Daftar Dosen</p>
</a>
</li>
--}}

<li class="nav-item">
    <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('admin/subjects*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p style="font-size: 18px;">Daftar Matakuliah</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('teachingPeriods.index') }}"
        class="nav-link {{ Request::is('admin/teachingPeriods*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar"></i>
        <p style="font-size: 18px;">Tahun Ajaran</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('classrooms.index') }}" class="nav-link {{ Request::is('admin/classrooms*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clock"></i>
        <p style="font-size: 18px;">Daftar Kelas</p>
    </a>
</li>

{{--
<li class="nav-item">
    <a href="{{ route('classroomUsers.index') }}" class="nav-link
{{ Request::is('admin/classroomUsers*') ? 'active' : '' }}">
<p style="font-size: 18px;">Classroom Users</p>
</a>
</li>

<li class="nav-item">
    <a href="{{ route('profiles.index') }}" class="nav-link {{ Request::is('admin/profiles*') ? 'active' : '' }}">
        <p style="font-size: 18px;">Profiles</p>
    </a>
</li>
--}}
<li class="nav-item
    {{ Request::is('admin/questions*') ? 'menu-is-opening menu-open' : '' }}
    {{ Request::is('admin/quizzes*') ? 'menu-is-opening menu-open' : '' }}
    ">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-question"></i>
        <p>
            Kuis & Soal
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('quizzes.index') }}" class="nav-link {{ Request::is('admin/quizzes*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p style="font-size: 18px;">Kuis</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('questions.index') }}"
                class="nav-link {{ Request::is('admin/questions*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>

                <p>Soal</p>
            </a>
        </li>
    </ul>
</li>
{{-- <li class="nav-item">
    <a href="{{ route('questionQuizzes.index') }}" class="nav-link
{{ Request::is('admin/questionQuizzes*') ? 'active' : '' }}">
<p>Question Quizzes</p>
</a>
</li>
<li class="nav-item">
    <a href="{{ route('teachables.index') }}" class="nav-link {{ Request::is('admin/teachables*') ? 'active' : '' }}">
        <p>Teachables</p>
    </a>
</li>
-
<li class="nav-item">
    <a href="{{ route('questionChoiceItems.index') }}"
        class="nav-link {{ Request::is('admin/questionChoiceItems*') ? 'active' : '' }}">
        <p>Question Choice Items</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('resources.index') }}" class="nav-link {{ Request::is('admin/resources*') ? 'active' : '' }}">
        <p>Resources</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('assignments.index') }}" class="nav-link {{ Request::is('admin/assignments*') ? 'active' : '' }}">
        <p>Assignments</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('quizAttempts.index') }}"
        class="nav-link {{ Request::is('admin/quizAttempts*') ? 'active' : '' }}">
        <p>Quiz Attempts</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('teachableUsers.index') }}"
        class="nav-link {{ Request::is('admin/teachableUsers*') ? 'active' : '' }}">
        <p>Teachable Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('grades.index') }}" class="nav-link {{ Request::is('admin/grades*') ? 'active' : '' }}">
        <p>Grades</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('modelHasRoles.index') }}"
        class="nav-link {{ Request::is('admin/modelHasRoles*') ? 'active' : '' }}">
        <p>Model Has Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('bookmarks.index') }}" class="nav-link {{ Request::is('admin/bookmarks*') ? 'active' : '' }}">
        <p>Bookmarks</p>
    </a>
</li> --}}

<li class="nav-header">Flashcard</li>

<li class="nav-item">
    <a href="{{ route('flashcardCategories.index') }}"
        class="nav-link {{ Request::is('admin/flashcardCategories*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Flashcard Categories</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('flashcardQuestions.index') }}"
        class="nav-link {{ Request::is('admin/flashcardQuestions*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Flashcard Questions</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('flashcardSubjects.index') }}"
        class="nav-link {{ Request::is('admin/flashcardSubjects*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Flashcard Subjects</p>
    </a>
</li>


{{-- <li class="nav-item">
    <a href="{{ route('flashcardCategoriesQuestions.index') }}"
class="nav-link {{ Request::is('admin/flashcardCategoriesQuestions*') ? 'active' : '' }}">
<p>Flashcard Categories Questions</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('flashcardQuestionsSubjects.index') }}"
        class="nav-link {{ Request::is('admin/flashcardQuestionsSubjects*') ? 'active' : '' }}">
        <p>Flashcard Questions Subjects</p>
    </a>
</li> --}}


<li class="nav-item">
    <a href="{{ route('flashcardAnswers.index') }}"
        class="nav-link {{ Request::is('admin/flashcardAnswers*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>

        <p>Flashcard Answers</p>
    </a>
</li>