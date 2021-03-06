<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start {{ active_route('admin.index') }}">
                <a href="{{ aurl('/') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ trans('main.dashboard') }}</span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ trans('main.users') }}</h3>
            </li>

            <li class="nav-item  {{ active_route('users.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">{{ trans('main.users') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('users.create') }}">
                        <a href="{{ route('users.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.user') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('users.index') }}">
                        <a href="{{ route('users.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.users') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  {{ active_route('roles.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-get-pocket"></i>
                    <span class="title">{{ trans('main.roles') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('roles.create') }}">
                        <a href="{{ route('roles.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.role') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('roles.index') }}">
                        <a href="{{ route('roles.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.roles') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  {{ active_route('permissions.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-tripadvisor"></i>
                    <span class="title">{{ trans('main.permissions') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('permissions.create') }}">
                        <a href="{{ route('permissions.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.permissions') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('permissions.index') }}">
                        <a href="{{ route('permissions.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.permissions') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Add Post  (Mario Added) -->
            <li class="heading">
                <h3 class="uppercase">{{ trans('main.libraries') }}</h3>
            </li>

            <li class="nav-item  {{ active_route('posts.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.posts') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('posts.create') }}">
                        <a href="{{ route('posts.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.post') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('posts.index') }}">
                        <a href="{{ route('posts.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.posts') }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('comments.create') }}">
                        <a href="{{ route('comments.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.comment') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('comments.index') }}">
                        <a href="{{ route('comments.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.comments') }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('events.create') }}">
                        <a href="{{ route('events.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.event') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('events.index') }}">
                        <a href="{{ route('events.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.events') }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('images.create') }}">
                        <a href="{{ route('images.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.image') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('images.index') }}">
                        <a href="{{ route('images.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.images') }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <!-- Add Post category  (Mario Added) -->
            <li class="heading">
                <h3 class="uppercase">{{ trans('main.categories') }}</h3>
            </li>

            <li class="nav-item  {{ active_route('categories.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-tree" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.categories') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('categories.create') }}">
                        <a href="{{ route('categories.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.category') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('categories.index') }}">
                        <a href="{{ route('categories.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.categories') }}</span>
                        </a>
                    </li>

                </ul>
            </li>

             <!-- Add Message By Mario -->
            <li class="heading">
                <h3 class="uppercase">{{ trans('main.messages') }}</h3>
            </li>

            <li class="nav-item  {{ active_route('messages.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-inbox" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.messages') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('messages.create') }}">
                        <a href="{{ route('messages.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.message') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('messages.index') }}">
                        <a href="{{ route('messages.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.messages') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Add Courses -->
            <li class="heading">
                <h3 class="uppercase">{{ trans('main.e_learning') }}</h3>
            </li>

            <li class="nav-item  {{ active_route('lessons.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-book" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.lessons') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('lessons.create') }}">
                        <a href="{{ route('lessons.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.lesson') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('lessons.index') }}">
                        <a href="{{ route('lessons.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.lessons') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Add Questions -->

            <li class="nav-item  {{ active_route('questions.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.questions') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('questions.create') }}">
                        <a href="{{ route('questions.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.question') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('questions.index') }}">
                        <a href="{{ route('questions.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.questions') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Add Courses -->
            <li class="nav-item  {{ active_route('courses.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-briefcase" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.courses') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('courses.create') }}">
                        <a href="{{ route('courses.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.course') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('courses.index') }}">
                        <a href="{{ route('courses.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.courses') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Add Faqs -->
            <li class="heading">
                <h3 class="uppercase">{{ trans('main.setting') }}</h3>
            </li>

            <li class="nav-item  {{ active_route('faqs.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-question" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.faqs') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('faqs.create') }}">
                        <a href="{{ route('faqs.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.faq') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('faqs.index') }}">
                        <a href="{{ route('faqs.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.faqs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  {{ active_route('files.*') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-file" aria-hidden="true"></i>
                    <span class="title">{{ trans('main.files') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active_route('files.create') }}">
                        <a href="{{ route('files.create') }}" class="nav-link ">
                            <span class="title">{{ trans('main.add') }} {{ trans('main.file') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_route('files.index') }}">
                        <a href="{{ route('files.index') }}" class="nav-link ">
                            <span class="title">{{ trans('main.show-all') }} {{ trans('main.files') }}</span>
                        </a>
                    </li>
                </ul>
            </li>



            <!-- Add Site Seeting   (Mario Added)

       </ul>
       <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
