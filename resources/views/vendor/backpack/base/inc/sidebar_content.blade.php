<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-o'></i> <span>Pages</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-list'></i> <span>Menu</span></a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>News</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper-o"></i> Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon la la-list"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-tag"></i> Tags</a></li>
    </ul>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Questions</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('question') }}'><i class='nav-icon la la-question'></i> Questions</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('answer') }}'><i class='nav-icon la la-question'></i> Answers</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('question-category') }}'><i class='nav-icon la la-question'></i> Question categories</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Sentences</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('russian') }}'><i class='nav-icon la la-question'></i> Russians</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('english') }}'><i class='nav-icon la la-question'></i> Englishes</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('language-category') }}'><i class='nav-icon la la-question'></i> Sentence categories</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Words</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('english-word') }}'><i class='nav-icon la la-question'></i> English words</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('russian-word') }}'><i class='nav-icon la la-question'></i> Russian words</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('word-category') }}'><i class='nav-icon la la-question'></i> Word categories</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Quizzes</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('quiz') }}'><i class='nav-icon la la-question'></i> Quizzes</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('quiz-category') }}'><i class='nav-icon la la-question'></i> Quiz categories</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('like') }}'><i class='nav-icon la la-question'></i> Likes</a></li>




<li class='nav-item'><a class='nav-link' href='{{ backpack_url('message') }}'><i class='nav-icon la la-question'></i> Messages</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('sponsor') }}'><i class='nav-icon la la-question'></i> Sponsors</a></li>