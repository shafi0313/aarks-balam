<div class="leftside-menu">
    <style>
        .logo img {
            width: 198px;
            height: 67px;
        }
    </style>
    <!-- Brand Logo Light -->
    <a href="{{ route('index') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('uploads/images/logo/b-alam.jpg') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('uploads/images/logo/b-alam.jpg') }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('index') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('uploads/images/logo/b-alam.jpg') }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('uploads/images/logo/b-alam.jpg') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    @php
        $categories = \App\Models\Category::with(['subCategories'])
            ->where('is_active', 1)
            ->get();
    @endphp
    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title mt-1"> Main</li>
            <li class="side-nav-item">
                <a href="{{ route('index') }}" class="side-nav-link">
                    <i class="fa-solid fa-gauge-simple-high"></i>
                    <span> Home </span>
                </a>
            </li>

            @foreach ($categories as $category)
                <li class="side-nav-item">
                    @if ($category->subCategories->count() > 0)
                        <a data-bs-toggle="collapse" href="#sidebarCategory{{ $category->id }}" aria-expanded="false"
                            aria-controls="sidebarCategory{{ $category->id }}" class="side-nav-link">
                            @if ($category->icon)
                                {!! $category->icon !!}
                            @else
                                <img src="{{ imagePath('category', $category->image) }}" width="15px" alt="">
                            @endif
                            <span> {{ $category->name }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                    @else
                        <a href="{{ route('product_by_category',$category->id) }}" class="side-nav-link">
                            @if ($category->icon)
                                {!! $category->icon !!}
                            @else
                                <img src="{{ imagePath('category', $category->image) }}" width="15px" alt="">
                            @endif
                            <span> {{ $category->name }} </span>
                        </a>
                    @endif

                    <div class="collapse" id="sidebarCategory{{ $category->id }}">
                        <ul class="side-nav-second-level">
                            @foreach ($category->subCategories as $subCategory)
                                <li>
                                    <a href="{{ route('product_by_sub_category', $subCategory->id) }}">{{ $subCategory->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach



            {{-- <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="ri-calendar-2-fill"></i>
                    <span> Calendar </span>
                </a>
            </li> --}}

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail"
                    class="side-nav-link">
                    <i class="ri-mail-fill"></i>
                    <span> Email </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Inbox</a>
                        </li>
                        <li>
                            <a href="#">Read Email</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="side-nav-title mt-2">Custom</li> --}}

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false"
                    aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <i class="ri-share-fill"></i>
                    <span> Multi Level </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMultiLevel">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false"
                                aria-controls="sidebarSecondLevel">
                                <span> Second Level </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSecondLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="javascript: void(0);">Item 1</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Item 2</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false"
                                aria-controls="sidebarThirdLevel">
                                <span> Third Level </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarThirdLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="javascript: void(0);">Item 1</a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#sidebarFourthLevel" aria-expanded="false"
                                            aria-controls="sidebarFourthLevel">
                                            <span> Item 2 </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarFourthLevel">
                                            <ul class="side-nav-forth-level">
                                                <li>
                                                    <a href="javascript: void(0);">Item 2.1</a>
                                                </li>
                                                <li>
                                                    <a href="javascript: void(0);">Item 2.2</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li> --}}


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
