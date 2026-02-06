<!DOCTYPE html>
<html
  lang="es"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="Admin {{ config('app.name') }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo_admin') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo_admin') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo_admin') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo_admin') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo_admin') }}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
            }
        }
    </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css')}}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js')}}"></script>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background: #323232cc!important;">
          <div class="app-brand demo justify-content-center" style="height:auto">
            <a href="{{ route('home') }}" class="app-brand-link">
              <span class="app-brand-logo pb-4">
                <img src="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}" style="max-width: 100px;" alt="">
              </span>
              
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          {{-- <div class="justify-content-center bg-black p-2 mx-auto w-100 d-flex justify-content-center" >
            <a href="{{ route('home') }}" class="app-brand-link">
              <span class="app-brand-text text-dorado demo menu-text fw-bolder ms-2 text-capitalize">{{ env('APP_NAME')}}</span>
            </a>
          </div> --}}

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1" style="background: linear-gradient(140deg, #eea94aff 0%, #d48a1fff 100%);">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="{{ route('dashboard') }}" class="menu-link {{Route::currentRouteName() == 'dashboard' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="{{ route('users') }}" class="menu-link {{Route::currentRouteName() == 'users' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Layouts">Usuarios</div>
              </a>

              {{-- para Activar colocar clase menu-toggle --}}
              {{-- <ul class="menu-sub">
                <li class="menu-item">
                  <a href="layouts-without-menu.html" class="menu-link">
                    <div data-i18n="Without menu">Without menu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-without-navbar.html" class="menu-link">
                    <div data-i18n="Without navbar">Without navbar</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-container.html" class="menu-link">
                    <div data-i18n="Container">Container</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-fluid.html" class="menu-link">
                    <div data-i18n="Fluid">Fluid</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-blank.html" class="menu-link">
                    <div data-i18n="Blank">Blank</div>
                  </a>
                </li>
              </ul> --}}
            </li>
            
            <li class="menu-item">
              <a href="{{ route('clientes') }}" class="menu-link {{Route::currentRouteName() == 'clientes' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Layouts">Clientes</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="{{ route('categorias') }}" class="menu-link {{Route::currentRouteName() == 'categorias' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Layouts">Categorías</div>
              </a>
            </li>

            @if(config('parts.colecciones'))
              <li class="menu-item">
                <a href="{{ route('colecciones') }}" class="menu-link {{Route::currentRouteName() == 'colecciones' ? 'active' : ''}}">
                  <i class="menu-icon tf-icons bx bx-grid"></i>
                  <div data-i18n="Layouts">Colecciones</div>
                </a>
              </li>
            @endif
            
            
            <li class="menu-item">
              <a href="{{ route('admin.posts') }}" class="menu-link {{Route::currentRouteName() == 'admin.posts' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div data-i18n="Layouts">Posts</div>
              </a>
            </li>
            
            
            <li class="menu-item">
              <a href="{{ route('productos') }}" class="menu-link {{Route::currentRouteName() == 'productos' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Layouts">Productos</div>
              </a>

              {{-- para Activar colocar clase menu-toggle --}}
              {{-- <ul class="menu-sub">
                <li class="menu-item">
                  <a href="layouts-without-menu.html" class="menu-link">
                    <div data-i18n="Without menu">Without menu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-without-navbar.html" class="menu-link">
                    <div data-i18n="Without navbar">Without navbar</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-container.html" class="menu-link">
                    <div data-i18n="Container">Container</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-fluid.html" class="menu-link">
                    <div data-i18n="Fluid">Fluid</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-blank.html" class="menu-link">
                    <div data-i18n="Blank">Blank</div>
                  </a>
                </li>
              </ul> --}}
            </li>
            
            <li class="menu-item">
              <a href="{{ route('ordenes') }}" class="menu-link {{Route::currentRouteName() == 'ordenes' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Layouts">Órdenes</div>
              </a>
            </li>
            
            {{-- <li class="menu-item">
              <a href="{{ route('pedidos') }}" class="menu-link {{Route::currentRouteName() == 'pedidos' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Layouts">Pedidos</div>
              </a>
            </li> --}}
{{--             
            <li class="menu-item">
              <a href="{{ route('facturacion') }}" class="menu-link {{Route::currentRouteName() == 'facturacion' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Layouts">Facturación</div>
              </a>
            </li> --}}

            @if(config('parts.sliders'))
            <li class="menu-item">
              <a href="{{ route('sliders') }}" class="menu-link {{Route::currentRouteName() == 'sliders' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-slideshow"></i>
                <div data-i18n="Layouts">Sliders</div>
              </a>
            </li>
            @endif

            @if(config('parts.comentarios'))
              <li class="menu-item">
                <a href="{{ route('comentarios') }}" class="menu-link {{Route::currentRouteName() == 'comentarios' ? 'active' : ''}}">
                  <i class="menu-icon tf-icons bx bx-comment-detail"></i>
                  <div data-i18n="Layouts">Comentarios</div>
                </a>
              </li>
            @endif

            @if(config('parts.envios'))
            <li class="menu-item">
              <a href="{{ route('ubicaciones') }}" class="menu-link {{Route::currentRouteName() == 'ubicaciones' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-location-plus"></i>
                <div data-i18n="Layouts">Ubicaciones / Envíos</div>
              </a>
            </li>
            @endif
              
            <li class="menu-item">
              <a href="{{ route('configuraciones') }}" class="menu-link {{Route::currentRouteName() == 'configuraciones' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Layouts">Configuraciones</div>
              </a>
            </li>

            
{{--             
            <li class="menu-item">
              <a href="{{ route('api.log') }}" class="menu-link {{Route::currentRouteName() == 'api.log' ? 'active' : ''}}">
                <i class="menu-icon tf-icons bx bx-customize"></i>
                <div data-i18n="Layouts">Api log</div>
              </a>
            </li>
             --}}
            <li class="menu-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                this.closest('form').submit();">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Cerrar Sesión</span>
                </a>
              </form>

            </li>
            
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    id="busqueda-pri"
                    class="form-control border-0 shadow-none"
                    placeholder="Buscar..."
                    aria-label="Buscar..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ auth()->user()->getProfilePhotoUrlAttribute() }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{auth()->user()->getProfilePhotoUrlAttribute()}}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Str::title(auth()->user()->name) }}</span>
                            <small class="text-muted">{{ auth()->user()->getRoleNames()->first() }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('panel') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Panel</span>
                      </a>
                    </li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">
                          <i class="bx bx-power-off me-2"></i>
                          <span class="align-middle">Cerrar Sesión</span>
                        </a>
                      </form>

                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              @isset($header)
                <h4 class="fw-bold py-3 mb-4">
                  <span class="text-muted fw-light">Admin /</span> 
                  {{ strip_tags($header) }}</h4>
              @endisset


              {{ $slot }}

            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  {{ env('APP_NAME')}}
                  {{-- , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a> --}}
                </div>
                <div>
                  {{-- <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  > --}}
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    @stack('modals')
    @livewireScripts
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('admin/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    @isset($vendorJs)
      {{ $vendorJs }}
    @endisset

    <!-- Main JS -->
    <script src="{{asset('admin/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    @isset($pageJs)
      {{ $pageJs }}
    @endisset

    <script>
          $(document).ready(function(){
            $('#busqueda-pri').keyup(function(){
              value = $(this).val();
              Livewire.emit('buscar' , value);
            });
          });
        </script>

    <script type="module">
      import {
          ClassicEditor,
          Essentials,
          Bold,
          Italic,
          Font,
          Paragraph,
          Alignment,
          List,
          Image,
          ImageUpload,
          ImageToolbar,
          ImageCaption,
          ImageStyle,
          ImageResizeEditing,
          ImageResizeHandles,
          MediaEmbed,
          Code,
          PasteFromOffice,
          AutoImage,
          SimpleUploadAdapter
      } from 'ckeditor5';

      window.editors = {};

          Livewire.on('render-ck', event => {

            setTimeout(() => {
                  ClassicEditor
                  .create( document.querySelector( '#editor-html' ), {    
                      plugins: [ 
                          Essentials,
                          Bold, 
                          Italic, 
                          Font, 
                          Paragraph ,
                          Alignment, 
                          List,
                          Image,
                          ImageUpload,
                          ImageToolbar,
                          ImageCaption,
                          ImageStyle,
                          ImageResizeEditing,
                          ImageResizeHandles,
                          MediaEmbed,
                          Code,
                          PasteFromOffice,
                          AutoImage,
                          SimpleUploadAdapter
                      ],
                      toolbar: {
                          items: [
                              'undo', 'redo',
                              '|',
                              'heading',
                              '|',
                              'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                              '|',
                              'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                              '|',
                              'link', 'uploadImage' , 'mediaEmbed', 'blockQuote', 'codeBlock', 
                              '|',
                              'alignment',
                              '|',
                              'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                          ]
                      },
                      mediaEmbed:{
                        previewsInData: true,  
                      },
                      image: {
                          toolbar: [ 'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText', '|' , 'toggleImageCaption', 'imageTextAlternative', 'ckboxImageEdit' ]
                      },
                      simpleUpload: {
                        uploadUrl: "{{ route('admin.upload.image') }}",
                        headers: {
                          'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                      }
                  } )
                  .then(newEditor => {
                          var editor = newEditor;
                          window.editors['editor-html'] = newEditor;
                          // console.log(window.editors);
                          editor.model.document.on('change:data', () => {
                              Livewire.emit('actualizarContenido', editor.getData());
                          });
                          Livewire.on('setData', contenido => {
                              // console.log(contenido)
                              editor.setData(contenido)
                          })
                          // Subir imagen al pegar
                          editor.editing.view.document.on('clipboardInput', (evt, data) => {
                              const images = Array.from(data.dataTransfer.files);
                              editor.execute('uploadImage', { file: images[0] });
                          });

                          
                      }
                  )
                  .catch( /* ... */ );
            }, 50); // Puedes ajustar el tiempo según sea necesario


        });
          

          

    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
