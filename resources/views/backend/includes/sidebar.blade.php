<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(navbar-${navbarStyle});
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation">
                <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
            </button>
        </div>
        <a class="navbar-brand" href="#">
            <div class="d-flex align-items-center py-3">
                <img class="me-2" src="{{ asset('adminassets/assets/img/icons/spot-illustrations/falcon.png') }}"
                    alt="" width="40">
                <span class="font-sans-serif">Admin</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="dashboard">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-chart-pie"></i>
                            </span>
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>
                    <ul class="nav collapse show" id="dashboard">
                        @can('list_services')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.services.index') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span class="nav-link-text ps-1">Service</span>
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('list_products')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span class="nav-link-text ps-1">Products</span>
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('list_userdetails')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.userdetails.index') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span class="nav-link-text ps-1">User Details</span>
                                </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>

                {{-- Beginning of Site Settings --}}
                @hasanyrole('superadmin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Site Settings</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'site-settings' ? '' : 'collapsed' }}"
                            href="#dashboard6" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'site-settings' ? 'true' : 'false' }}"
                            aria-controls="dashboard6">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-link-text ps-1">Site Settings</span>
                            </div>
                        </a>
                        <ul class="nav collapse {{ Request::segment(2) == 'site-settings' ? 'show' : '' }}" id="dashboard6">
                            @can('list_site_settings')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'site-settings' ? 'active' : '' }}"
                                        href="{{ route('admin.site-settings.index') }}">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-angle-double-right"></i> Site Setting
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            {{-- Insert Favicon Menu Item here --}}
                            @can('list_favicons')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'favicons' ? 'active' : '' }}"
                                        href="{{ route('admin.favicons.index') }}">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-angle-double-right"></i> Favicon
                                        </div>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    </li>
                @endhasanyrole
                {{-- End of Site Settings --}}





  <li class="nav-item">
        <a class="nav-link {{ Request::segment(2) == 'navigate' ? 'active' : '' }}"
            href="{{ route('admin.navigate.index') }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-map-signs"></i>
                <span class="nav-link-text ps-1">Navigate</span>
            </div>
        </a>
    </li>



                {{-- Beginning of Contact Details --}}
                @hasanyrole('superadmin|admin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Contact Details</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'contact-details' ? '' : 'collapsed' }}"
                            href="#dashboard18" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'contact-details' ? 'true' : 'false' }}"
                            aria-controls="dashboard18">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-link-text ps-1">Contact Details</span>
                            </div>
                        </a>
                        <ul class="nav collapse {{ Request::segment(2) == 'contact-details' ? 'show' : '' }}"
                            id="dashboard18">
                            {{-- Visitors Book --}}
                            @can('list_visitors_book')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'contact-details' && Request::segment(3) == 'visitors-book' ? 'active' : '' }}"
                                        href="{{ route('admin.visitors-book.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Visitors Book
                                        </div>
                                    </a>
                                </li>
                            @endcan

                            {{-- CEO Message
                            @can('list_ceomessage')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'contact-details' && Request::segment(3) == 'ceomessage' ? 'active' : '' }}"
                                        href="{{ route('admin.ceomessage.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            CEO Message
                                        </div>
                                    </a>
                                </li>
                            @endcan --}}

                            {{-- Student Details --}}
                            @can('list_student_details')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'contact-details' && Request::segment(3) == 'student-details' ? 'active' : '' }}"
                                        href="{{ route('admin.student-details.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Worker Details
                                        </div>
                                    </a>
                                </li>
                            @endcan

                            {{-- Contacts --}}
                            @can('list_contacts')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'contact-details' && Request::segment(3) == 'contacts' ? 'active' : '' }}"
                                        href="{{ route('admin.contacts.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Contacts
                                        </div>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    </li>
                @endhasanyrole
                {{-- End of Contact Details --}}



                {{-- Beginning of Informations --}}
                {{-- 
                @hasanyrole('superadmin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Informations</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#dashboard15" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard15">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-link-text ps-1">Informations</span>
                            </div>
                        </a>
                        <ul class="nav collapse {{ Request::segment(2) == 'informations' ? 'show' : '' }}"
                            id="dashboard15">
                         
                            @can('list_countries')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'countries' ? 'active' : '' }}"
                                        href="{{ route('admin.countries.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Country
                                        </div>
                                    </a>
                                </li>
                            @endcan

                          
                            @can('list_companies')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'company' ? 'active' : '' }}"
                                        href="{{ route('admin.companies.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Company
                                        </div>
                                    </a>
                                </li>
                            @endcan

                           
                            @can('list_work_categories')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'work-category' ? 'active' : '' }}"
                                        href="{{ route('admin.work_categories.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Work Category
                                        </div>
                                    </a>
                                </li>
                            @endcan

                        


                        
                             @can('list_applications')
                             <li class="nav-item">
                                 <a class="nav-link {{ Request::segment(2) == 'applications' ? 'active' : '' }}"
                                     href="{{ route('admin.applications.index') }}">
                                     <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                         Applications
                                     </div>
                                 </a>
                             </li>
                         @endcan
                        </ul>
                    </li>
                    </li>
                @endhasanyrole


                 --}}
                {{-- End of Informations --}}



                {{-- Beginning of Introduction --}}
                @hasanyrole('superadmin')
                    <li class="nav-item">
                        <!-- Navbar vertical label -->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Introduction</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                        <!-- Dropdown item -->
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'about-us' || Request::segment(2) == 'cover-images' || Request::segment(2) == 'services' || Request::segment(2) == 'team' ? '' : 'collapsed' }}"
                            href="#dashboardIntro" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'about-us' || Request::segment(2) == 'cover-images' || Request::segment(2) == 'services' || Request::segment(2) == 'team' ? 'true' : 'false' }}"
                            aria-controls="dashboardIntro">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-link-text ps-1">Introduction</span>
                            </div>
                        </a>
                        <!-- Collapse content -->
                        <ul class="nav collapse {{ Request::segment(2) == 'about-us' || Request::segment(2) == 'cover-images' || Request::segment(2) == 'services' || Request::segment(2) == 'team' ? 'show' : '' }}"
                            id="dashboardIntro">
                            {{-- About Us --}}
                         <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'about-us' ? 'active' : '' }}"
                                    href="{{ route('admin.about-us.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="nav-link-text ps-1">About Us</span>
                                    </div>
                                </a>
                            </li>
                            {{-- Cover Image --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'cover-images' ? 'active' : '' }}"
                                    href="{{ route('admin.cover-images.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="nav-link-text ps-1">Cover Image</span>
                                    </div>
                                </a>
                            </li>
                            {{-- Services 
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'services' ? 'active' : '' }}"
                                    href="{{ route('admin.services.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="nav-link-text ps-1">Services</span>
                                    </div>
                                </a>
                            </li>

--}}

                            {{-- Teams --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'team' ? 'active' : '' }}"
                                    href="{{ route('admin.teams.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="nav-link-text ps-1">Teams</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li> <!-- Corrected closing tag -->
                    </li>
                @endhasanyrole
                {{-- End of Introduction --}}

                {{-- Beginning of Section Pictures --}}
                @hasanyrole('superadmin|admin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Section Pictures</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ in_array(Request::segment(2), ['sectiononepicture','sectiontwopicture','sectionthreepicture','sectionfourpicture']) ? '' : 'collapsed' }}"
                            href="#dashboardSectionPictures" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ in_array(Request::segment(2), ['sectiononepicture','sectiontwopicture','sectionthreepicture','sectionfourpicture']) ? 'true' : 'false' }}"
                            aria-controls="dashboardSectionPictures">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-images"></i></span>
                                <span class="nav-link-text ps-1">Section Pictures</span>
                            </div>
                        </a>
                        <ul class="nav collapse {{ in_array(Request::segment(2), ['sectiononepicture','sectiontwopicture','sectionthreepicture','sectionfourpicture']) ? 'show' : '' }}"
                            id="dashboardSectionPictures">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'sectiononepicture' ? 'active' : '' }}" href="{{ route('admin.sectiononepicture.index') }}">
                                    <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i> Section One</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'sectiontwopicture' ? 'active' : '' }}" href="{{ route('admin.sectiontwopicture.index') }}">
                                    <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i> Section Two</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'sectionthreepicture' ? 'active' : '' }}" href="{{ route('admin.sectionthreepicture.index') }}">
                                    <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i> Section Three</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'sectionfourpicture' ? 'active' : '' }}" href="{{ route('admin.sectionfourpicture.index') }}">
                                    <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i> Section Four</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                @endhasanyrole
                {{-- End of Section Pictures --}}



@hasanyrole('superadmin|admin')
<li class="nav-item">
  <!-- Dropdown trigger -->
  <a class="nav-link dropdown-indicator {{ in_array(Request::segment(2), ['why-us', 'event', 'faqs', 'notifications', 'careers']) ? '' : 'collapsed' }}"
     href="#updateDropdown"
     role="button"
     data-bs-toggle="collapse"
     aria-expanded="{{ in_array(Request::segment(2), ['why-us', 'event', 'faqs', 'notifications', 'careers']) ? 'true' : 'false' }}"
     aria-controls="updateDropdown">
    <div class="d-flex align-items-center">
      <span class="nav-link-icon"><i class="fas fa-edit"></i></span>
      <span class="nav-link-text ps-1">Update</span>
    </div>
  </a>

  <!-- Dropdown contents -->
  <ul class="nav collapse {{ in_array(Request::segment(2), ['why-us', 'event', 'blogs', 'notifications', 'careers']) ? 'show' : '' }}"
      id="updateDropdown">

    <!-- Why Us -->
    @hasrole('superadmin')
    <li class="nav-item">
      <a class="nav-link {{ Request::segment(2) == 'why-us' ? 'active' : '' }}"
         href="{{ route('backend.whyus.index') }}">
        <div class="d-flex align-items-center">
          <i class="fa fa-angle-double-right"></i>
          <span class="nav-link-text ps-1">Why Us</span>
        </div>
      </a>
    </li>
    @endhasrole

    <!-- Event -->
    @hasrole('superadmin')
    <li class="nav-item">
      <a class="nav-link {{ Request::segment(2) == 'event' ? 'active' : '' }}"
         href="{{ route('backend.event.index') }}">
        <div class="d-flex align-items-center">
          <i class="fa fa-angle-double-right"></i>
          <span class="nav-link-text ps-1">Event</span>
        </div>
      </a>
    </li>
    @endhasrole

    <!-- Notifications -->
    <li class="nav-item">
      <a class="nav-link {{ Request::segment(2) == 'notifications' ? 'active' : '' }}"
         href="{{ route('admin.notifications.index') }}">
        <div class="d-flex align-items-center">
          <i class="fa fa-bell"></i>
          <span class="nav-link-text ps-1">Notifications</span>
        </div>
      </a>
    </li>

    <!-- Career Opportunities -->
   

    <!-- Blogs -->
    <li class="nav-item">
      <a class="nav-link {{ Request::segment(2) == 'blogs' ? 'active' : '' }}"
         href="{{ route('admin.blog-posts-categories.index') }}">
        <div class="d-flex align-items-center">
          <i class="fa fa-angle-double-right"></i>
          <span class="nav-link-text ps-1">Blogs</span>
        </div>
      </a>
    </li>

  </ul>
</li>
@endhasanyrole


@hasanyrole('superadmin')
    <li class="nav-item">
        <!-- Navbar vertical label -->
        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Opportunities</div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider">
            </div>
        </div>

        <!-- Dropdown item -->
        <li class="nav-item">
            <a class="nav-link dropdown-indicator 
                {{ Request::segment(2) == 'careers' || Request::segment(2) == 'career-applications' ? '' : 'collapsed' }}"
               href="#opportunitiesMenu" role="button" data-bs-toggle="collapse"
               aria-expanded="{{ Request::segment(2) == 'careers' || Request::segment(2) == 'career-applications' ? 'true' : 'false' }}"
               aria-controls="opportunitiesMenu">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><i class="fas fa-briefcase"></i></span>
                    <span class="nav-link-text ps-1">Opportunities</span>
                </div>
            </a>

            <!-- Collapse content -->
            <ul class="nav collapse {{ Request::segment(2) == 'careers' || Request::segment(2) == 'career-applications' ? 'show' : '' }}"
                id="opportunitiesMenu">

                {{-- Career Opportunities --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) == 'careers' ? 'active' : '' }}"
                       href="{{ route('admin.careers.index') }}">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-angle-double-right"></i>
                            <span class="nav-link-text ps-1">Career Opportunities</span>
                        </div>
                    </a>
                </li>

                {{-- Application Reports --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) == 'career-applications' ? 'active' : '' }}"
                       href="{{ route('admin.career-applications.index') }}">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-angle-double-right"></i>
                            <span class="nav-link-text ps-1">Application Reports</span>
                        </div>
                    </a>
                </li>
            </ul>
        </li> <!-- Corrected closing tag -->
    </li>
@endhasanyrole



                {{-- Beginning of Posts --}}
                {{-- 
                @hasanyrole('superadmin')
                    <li class="nav-item">
                        <!-- Navbar vertical label -->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Posts</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                        <!-- Dropdown item -->
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'posts' ? '' : 'collapsed' }}"
                            href="#dashboard23" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'posts' ? 'true' : 'false' }}"
                            aria-controls="dashboard23">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-link-text ps-1">Posts</span>
                            </div>
                        </a>
                        <!-- Collapse content -->
                        <ul class="nav collapse {{ Request::segment(2) == 'posts' ? 'show' : '' }}" id="dashboard23">
                        
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'categories' ? 'active' : '' }}"
                                    href="{{ route('admin.categories.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="nav-link-text ps-1">Categories</span>
                                    </div>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(3) == 'create' || (Request::segment(2) == 'posts' && Request::segment(3) != 'categories') ? 'active' : '' }}"
                                    href="{{ route('admin.posts.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-angle-double-right"></i>
                                        <span class="nav-link-text ps-1">Post</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li> 
                    </li>
                @endhasanyrole
                 --}}
                {{-- End of Posts --}}





                {{-- Beginning of Gallery --}}

                @hasanyrole('superadmin|admin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Gallery</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#dashboard11" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i
                                        class="fas fa-users"></i></span><span class="nav-link-text ps-1">Gallery
                                </span></div>
                        </a>
                        <ul class="nav collapse  {{ Request::segment(2) == 'photo-galleries' || Request::segment(2) == 'video-galleries' ? 'show' : '' }}"
                            id="dashboard11">
                            @can('list_photo_galleries')
                                <li class="nav-item"><a
                                        class="nav-link {{ Request::segment(2) == 'photo-galleries' ? 'active' : '' }}"
                                        href="{{ route('admin.photo-galleries.index') }}">
                                        <div class="d-flex align-items-center"><i class="fa fa-angle-double-right"></i>
                                            Photo Gallery

                                        </div>
                                    </a>
                                </li>
                            @endcan

                            @can('list_video_galleries')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'video-galleries' ? 'active' : '' }}"
                                        href="{{ route('admin.video-galleries.index') }}">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-angle-double-right"></i> Video Gallery
                                        </div>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    </li>
                @endhasanyrole

                {{-- End of Gallery --}}






                {{-- Beginning of Student Reviews --}}
                {{--  
                @hasanyrole('superadmin|admin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Student Reviews</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#dashboard16" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard16">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i
                                        class="fas fa-users"></i></span><span class="nav-link-text ps-1">Testimonials
                                </span></div>
                        </a>
                        <ul class="nav collapse  {{ Request::segment(2) == 'testimonials' ? 'show' : '' }}"
                            id="dashboard16">
                            @can('list_testimonials')
                                
                            @endcan

                        </ul>
                    </li>
                    </li>
                    
                @endhasanyrole
                --}}
        

                {{-- Beginning of FAQs --}}
                @hasanyrole('superadmin|admin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">FAQs</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'faqs' ? 'active' : '' }}"
                            href="#faq" role="button" data-bs-toggle="collapse" aria-expanded="true"
                            aria-controls="faq">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-question-circle"></i></span>
                                <span class="nav-link-text ps-1">FAQs</span>
                            </div>
                        </a>
                        <ul class="nav collapse {{ Request::segment(2) == 'faqs' ? 'show' : '' }}" id="faq">
                            {{-- FAQs --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'faqs' ? 'active' : '' }}"
                                    href="{{ route('admin.faqs.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-list"></i>
                                        <span class="nav-link-text ps-1">Procurement</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                @endhasanyrole
                {{-- End of FAQs --}}

                {{-- Beginning of CEOMESSAGE --}}
               @hasanyrole('superadmin')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">CEO Messages</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'ceomessage' ? 'active' : '' }}"
                            href="#d_msg" role="button" data-bs-toggle="collapse" aria-expanded="true"
                            aria-controls="d_msg">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-question-circle"></i></span>
                                <span class="nav-link-text ps-1">CEO Messages</span>
                            </div>
                        </a>
                        <ul class="nav collapse {{ Request::segment(2) == 'ceomessage' ? 'show' : '' }}"
                            id="d_msg" id="dashboard21">
                            {{-- CEO Messages --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'ceomessage' ? 'active' : '' }}"
                                    href="{{ route('admin.ceomessage.index') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-list"></i>
                                        <span class="nav-link-text ps-1">CEO Message</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                @endhasanyrole
                {{-- End of CEOMESSAGE --}}


                 {{-- 
@hasanyrole('superadmin|admin')
<li class="nav-item">
    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
        <div class="col-auto navbar-vertical-label">Our Clients</div>
        <div class="col ps-0">
            <hr class="mb-0 navbar-vertical-divider">
        </div>
    </div>
    <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'clients' ? 'active' : '' }}"
       href="#clients" role="button" data-bs-toggle="collapse" aria-expanded="true"
       aria-controls="clients">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="fas fa-question-circle"></i></span>
            <span class="nav-link-text ps-1">Our Clients</span>
        </div>
    </a>
    <ul class="nav collapse {{ Request::segment(2) == 'clients' ? 'show' : '' }}" id="clients">
       
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(2) == 'clients' ? 'active' : '' }}"
               href="{{ route('admin.client.index') }}">
                <div class="d-flex align-items-center">
                    <i class="fa fa-list"></i>
                    <span class="nav-link-text ps-1">Clients</span>
                </div>
            </a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(2) == 'clients' ? 'active' : '' }}"
               href="{{ route('admin.client_messages.index') }}">
                <div class="d-flex align-items-center">
                    <i class="fa fa-list"></i>
                    <span class="nav-link-text ps-1">Clients Messages</span>
                </div>
            </a>
        </li>
    </ul>
</li>
@endhasanyrole

--}}
{{-- Beginning of Testimonials --}}
{{-- Testimonials Section --}}
@hasanyrole('superadmin|admin')
    <li class="nav-item">
        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Testimonials</div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider">
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::segment(2) == 'testimonials' ? 'active' : '' }}"
            href="{{ route('admin.testimonials.index') }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-angle-double-right"></i>
                <span class="nav-link-text ps-1">Testimonials</span>
            </div>
        </a>
    </li>
@endhasanyrole
@hasanyrole('superadmin|admin')
    <li class="nav-item">
        <div class="row navbar-vertical-label-wrapper mt-4 mb-3">
            <div class="col-auto navbar-vertical-label fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem; color: #495057;">
                <i class="fas fa-cog me-1"></i>Meta Settings
            </div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider">
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link dropdown-indicator {{ in_array(Request::segment(2), ['seo_settings','blogmeta','contactmeta','aboutmeta','servicemeta','whymeta','gallerymeta','careermeta','testimonialmeta','productonemeta','producttwometa','productthreemeta','productfourmeta','productfivemeta','singlepagemeta','singleblogpagemeta','singleservicepagemeta','singleproductpagemeta']) ? '' : 'collapsed' }}"
           href="#metaSettingsDropdown" role="button" data-bs-toggle="collapse"
           aria-expanded="{{ in_array(Request::segment(2), ['seo_settings','blogmeta','contactmeta','aboutmeta','servicemeta','whymeta','gallerymeta','careermeta','testimonialmeta','productonemeta','producttwometa','productthreemeta','productfourmeta','productfivemeta','singlepagemeta','singleblogpagemeta','singleservicepagemeta','singleproductpagemeta']) ? 'true' : 'false' }}"
           aria-controls="metaSettingsDropdown">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon" style="color: #6c757d;"><i class="fas fa-tags"></i></span>
                <span class="nav-link-text ps-1 fw-500">Meta Settings</span>
            </div>
        </a>

        <ul class="nav collapse {{ in_array(Request::segment(2), ['seo_settings','blogmeta','contactmeta','aboutmeta','servicemeta','whymeta','gallerymeta','careermeta','testimonialmeta','productonemeta','producttwometa','productthreemeta','productfourmeta','productfivemeta','singlepagemeta','singleblogpagemeta','singleservicepagemeta','singleproductpagemeta']) ? 'show' : '' }}" id="metaSettingsDropdown" style="background: rgba(108, 117, 125, 0.03); border-radius: 0.375rem; margin: 0.5rem 0; padding: 0.25rem 0;">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/seo_settings*') ? 'active' : '' }}" href="{{ route('admin.seo_settings.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-search" style="width: 14px; color: #0d6efd; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">SEO Settings</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'blogmeta' ? 'active' : '' }}" href="{{ route('admin.blogmeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-newspaper-o" style="width: 14px; color: #198754; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Blog Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'contactmeta' ? 'active' : '' }}" href="{{ route('admin.contactmeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-envelope" style="width: 14px; color: #dc3545; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Contact Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'aboutmeta' ? 'active' : '' }}" href="{{ route('admin.aboutmeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-info-circle" style="width: 14px; color: #0dcaf0; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">About Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'servicemeta' ? 'active' : '' }}" href="{{ route('admin.servicemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-cogs" style="width: 14px; color: #ffc107; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Service Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'whymeta' ? 'active' : '' }}" href="{{ route('admin.whymeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-lightbulb-o" style="width: 14px; color: #fd7e14; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Why Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'gallerymeta' ? 'active' : '' }}" href="{{ route('admin.gallerymeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-image" style="width: 14px; color: #e83e8c; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Gallery Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'careermeta' ? 'active' : '' }}" href="{{ route('admin.careermeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-briefcase" style="width: 14px; color: #20c997; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Career Meta</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'testimonialmeta' ? 'active' : '' }}" href="{{ route('admin.testimonialmeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-star" style="width: 14px; color: #6f42c1; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Testimonial Meta</span></div>
                </a>
            </li>

            <li class="nav-item" style="border-top: 1px solid rgba(108, 117, 125, 0.15); margin: 0.5rem 0; padding-top: 0.5rem;">
                <a class="nav-link {{ Request::segment(2) == 'productonemeta' ? 'active' : '' }}" href="{{ route('admin.productonemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-cube" style="width: 14px; color: #343a40; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Product One</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'producttwometa' ? 'active' : '' }}" href="{{ route('admin.producttwometa.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-cube" style="width: 14px; color: #495057; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Product Two</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'productthreemeta' ? 'active' : '' }}" href="{{ route('admin.productthreemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-cube" style="width: 14px; color: #6c757d; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Product Three</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'productfourmeta' ? 'active' : '' }}" href="{{ route('admin.productfourmeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-cube" style="width: 14px; color: #868e96; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Product Four</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'productfivemeta' ? 'active' : '' }}" href="{{ route('admin.productfivemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-cube" style="width: 14px; color: #adb5bd; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Product Five</span></div>
                </a>
            </li>

            <li class="nav-item" style="border-top: 1px solid rgba(108, 117, 125, 0.15); margin: 0.5rem 0; padding-top: 0.5rem;">
                <a class="nav-link {{ Request::segment(2) == 'singlepagemeta' ? 'active' : '' }}" href="{{ route('admin.singlepagemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-file-text-o" style="width: 14px; color: #0d6efd; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">Single Page</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'singleblogpagemeta' ? 'active' : '' }}" href="{{ route('admin.singleblogpagemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-file-text-o" style="width: 14px; color: #20c997; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">single Blog Page</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'singleservicepagemeta' ? 'active' : '' }}" href="{{ route('admin.singleservicepagemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-file-text-o" style="width: 14px; color: #ffc107; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">single Service Page</span></div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'singleproductpagemeta' ? 'active' : '' }}" href="{{ route('admin.singleproductpagemeta.index') }}" style="padding-left: 2rem; font-size: 0.875rem;">
                    <div class="d-flex align-items-center"><i class="fa fa-file-text-o" style="width: 14px; color: #6f42c1; margin-right: 0.5rem;"></i><span class="nav-link-text" style="padding-left: 0;">single Product Page</span></div>
                </a>
            </li>
        </ul>
    </li>
@endhasanyrole

@hasanyrole('superadmin|admin')
    <li class="nav-item">
        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Mission/Vision/Value</div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider">
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/missionvisionvalue*') ? 'active' : '' }}"
           href="{{ route('admin.missionvisionvalue.index') }}" 
           aria-current="{{ Request::is('admin/missionvisionvalue*') ? 'page' : '' }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-angle-double-right"></i>
                <span class="nav-link-text ps-1">Mission/Vision/Value</span>
            </div>
        </a>
    </li>
@endhasanyrole

@hasanyrole('superadmin|admin')
    <li class="nav-item">
        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Section   Picture</div>
            <div class="col ps-0">
                <hr class="mb-0 navbar-vertical-divider">
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/sectiononepicture*') ? 'active' : '' }}"
           href="{{ route('admin.sectiononepicture.index') }}"
           aria-current="{{ Request::is('admin/sectiononepicture*') ? 'page' : '' }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-angle-double-right"></i>
                <span class="nav-link-text ps-1">Section One Picture</span>
            </div>
        </a>
    </li>


    
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/sectiononepicture*') ? 'active' : '' }}"
           href="{{ route('admin.sectiononepicture.index') }}"
           aria-current="{{ Request::is('admin/sectiononepicture*') ? 'page' : '' }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-angle-double-right"></i>
                <span class="nav-link-text ps-1">Section two Picture</span>
            </div>
        </a>
    </li>
        
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/sectiononepicture*') ? 'active' : '' }}"
           href="{{ route('admin.sectiononepicture.index') }}"
           aria-current="{{ Request::is('admin/sectiononepicture*') ? 'page' : '' }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-angle-double-right"></i>
                <span class="nav-link-text ps-1">Section three Picture</span>
            </div>
        </a>
            
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/sectiononepicture*') ? 'active' : '' }}"
           href="{{ route('admin.sectiononepicture.index') }}"
           aria-current="{{ Request::is('admin/sectiononepicture*') ? 'page' : '' }}">
            <div class="d-flex align-items-center">
                <i class="fa fa-angle-double-right"></i>
                <span class="nav-link-text ps-1">Section four Picture</span>
            </div>
        </a>

@endhasanyrole








             {{-- End of Our Clients --}}


            </ul>
        </div>
    </div>


</nav>