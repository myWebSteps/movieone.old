import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_BASE_URL || '/'),

    routes: [
        //Front Routes
        {
            path: '/',
            name: 'FrontLayout',
            components: {
                default: () => import('./components/FrontLayout.vue'),
            },
            children: [
                {
                    path: '/',
                    name: 'home',
                    components: {
                        default: () => import('./components/front/Home.vue'),
                    },
                    meta: {
                        title: 'MovieOne.ru Онлайн кинотеатр',
                        filter: false,
                        pageTitle: false,
                    }
                },
                {
                    path: '/films/search',
                    name: 'search_by_key',
                    components: {
                        default: () => import('./components/front/Films/Search.vue'),
                    },
                    props: true,
                    meta: {
                        title: 'Поиск фильмов по ключам',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/films',
                    name: 'films',
                    components: {
                        default: () => import('./components/front/Films/Index.vue'),
                    },
                    props: true,
                    meta: {
                        title: 'Список актуальных фильмов',
                        filter: true,
                        pageTitle: true
                    }
                },
                {
                    path: '/films/:id',
                    name: 'film',
                    components: {
                        default: () => import('./components/front/Films/Single.vue'),
                    },
                    props: true,
                    meta: {
                        title: 'Фильм',
                        filter: false,
                        pageTitle: false
                    }
                },

            ],
        },

        //Auth Routes

        {
            path: '/auth',
            name: 'AuthLayout',
            components: {
                default: () => import('./components/AuthLayout.vue'),
            },
            meta: {
                title: 'Authentification',
                filter: false,
                pageTitle: false
            },
            children: [
                {
                    path: '/auth/login',
                    name: 'login',
                    components: {
                        default: () => import('./components/auth/Login.vue'),
                    },
                    meta: {
                        title: 'Вход в личный кабинет',
                        filter: false,
                        pageTitle: false
                    },
                },
                // {
                //     path: '/auth/register',
                //     name: 'register',
                //     components: {
                //         default: () => import('./components/auth/Register.vue'),
                //     },
                //     props: true,
                //     meta: {
                //         title: 'Register',
                //         filter: false,
                //         pageTitle: false
                //     }
                // },
            ]
        },

        //Admin Routes
        {
            path: '/admin',
            name: 'AdminLayout',
            components: {
                default: () => import('./components/AdminLayout.vue'),
            },
            props: true,
            meta: {
                middleware: 'AdminMiddleware',
                title: 'Admin panel',
                filter: false,
                pageTitle: false
            },
            children:[
                {
                    path: '/admin',
                    name: 'admin',
                    components: {
                        default: () => import('./components/back/Main.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Панель администратора',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/admin/categories',
                    name: 'admin.categories',
                    components: {
                        default: () => import('./components/back/Categories/Index.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Добавление категории',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/admin/subcategories',
                    name: 'admin.subcategories',
                    components: {
                        default: () => import('./components/back/Subcategories/Index.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Добавление Субкатегории',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/admin/add_video',
                    name: 'add_video',
                    components: {
                        default: () => import('./components/back/Video/Create.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Добавить видео',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/admin/redact_video/:id',
                    name: 'redact_video',
                    components: {
                        default: () => import('./components/back/Video/Update.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Редактировать видео',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/admin/videos',
                    name: 'videos',
                    components: {
                        default: () => import('./components/back/Video/Index.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Список видео',
                        filter: false,
                        pageTitle: false
                    }
                },
                {
                    path: '/admin/countries',
                    name: 'countries',
                    components: {
                        default: () => import('./components/back/Countries/Index.vue'),
                    },
                    props: true,
                    meta: {
                        middleware: 'AdminMiddleware',
                        title: 'Список стран',
                        filter: false,
                        pageTitle: false
                    }
                },
            ]
        },

        {
            path: "/:catchAll(.*)",
            name: 'error_404',
            props: true,
            components:{
                default: () => import('./components/ErrorComponent.vue'),
            },
            meta: {
                title: 'error_404',
            }
        },


    ]
})

router.beforeEach((to, from, next)=>{

    console.log(to)




    if(to.meta.middleware != null) {
                    if (to.meta.middleware == 'AdminMiddleware') {
                        axios.get('/api/user')
                            .then(r => {
                            if (r.data.role != '1') {
                                return next({name: 'login'})
                            }else{
                                return next()
                            }
                        })
                            .catch(e=>{
                                return next({name: 'login'})
                            })

                    }
                }else{
                    return next()
                }

})
router.afterEach((to, from)=>{



    if(to.name == 'film'){
        axios.get(`/api/movie/${this.to.params.id}`)
            .then(resp=>{
                document.title = this.movie.nameRu + ' : смотреть бесплатно и без регистрации'

            });
    }else{
      document.title = to.meta.title;
    }


})

export default router
