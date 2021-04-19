<li class="nav-item">
    <a href="{{ route('admin.home') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p style="font-size: 18px;">
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('userStudents.index') }}" class="nav-link {{ Request::is('userStudents*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p style="font-size: 18px;">Daftar Mahasiswa</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('userTeachers.index') }}" class="nav-link {{ Request::is('userTeachers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <p style="font-size: 18px;">Daftar Dosen</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p style="font-size: 18px;">Daftar Matakuliah</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('teachingPeriods.index') }}"
        class="nav-link {{ Request::is('teachingPeriods*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar"></i>
        <p style="font-size: 18px;">Tahun Ajaran</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('classrooms.index') }}" class="nav-link {{ Request::is('classrooms*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clock"></i>
        <p style="font-size: 18px;">Daftar Kelas</p>
    </a>
</li>

{{-- <li class="nav-item">
    <a href="{{ route('classroomUsers.index') }}"
class="nav-link {{ Request::is('classroomUsers*') ? 'active' : '' }}">
<p style="font-size: 18px;">Classroom Users</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('profiles.index') }}" class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}">
        <p style="font-size: 18px;">Profiles</p>
    </a>
</li> --}}
<li class="nav-item 
    {{ Request::is('questions*') ? 'menu-is-opening menu-open' : '' }}
    {{ Request::is('quizzes*') ? 'menu-is-opening menu-open' : '' }}
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
            <a href="{{ route('quizzes.index') }}" class="nav-link {{ Request::is('quizzes*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p style="font-size: 18px;">Kuis</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('questions.index') }}" class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>

                <p>Soal</p>
            </a>
        </li>
    </ul>
</li>
{{-- <li class="nav-item">
    <a href="{{ route('questionQuizzes.index') }}"
class="nav-link {{ Request::is('questionQuizzes*') ? 'active' : '' }}">
<p>Question Quizzes</p>
</a>
</li>
<li class="nav-item">
    <a href="{{ route('teachables.index') }}" class="nav-link {{ Request::is('teachables*') ? 'active' : '' }}">
        <p>Teachables</p>
    </a>
</li> - --}}
{{-- <li class="nav-item">
    <a href="{{ route('questionChoiceItems.index') }}"
class="nav-link {{ Request::is('questionChoiceItems*') ? 'active' : '' }}">
<p>Question Choice Items</p>
</a>
</li> --}}
{{-- <li class="nav-item">
    <a href="{{ route('resources.index') }}"
class="nav-link {{ Request::is('resources*') ? 'active' : '' }}">
<p>Resources</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('assignments.index') }}" class="nav-link {{ Request::is('assignments*') ? 'active' : '' }}">
        <p>Assignments</p>
    </a>
</li> --}}<li class="nav-item">
    <a href="{{ route('quizAttempts.index') }}"
       class="nav-link {{ Request::is('quizAttempts*') ? 'active' : '' }}">
        <p>Quiz Attempts</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('teachableUsers.index') }}"
       class="nav-link {{ Request::is('teachableUsers*') ? 'active' : '' }}">
        <p>Teachable Users</p>
    </a>
</li>


