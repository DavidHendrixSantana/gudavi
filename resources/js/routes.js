
const Home = () => import("./components/Home.vue");
const Listado = () => import("./components/Listado.vue");
const Modal = () => import("./components/Modal.vue");


//importamos los componentes para el  schedule
const Index_schedule = () => import("./components/schedule/Index.vue");
const Create_schedule = () => import("./components/schedule/Create.vue");
const Edit_schedule = () => import("./components/schedule/Edit.vue");

//importamos los componentes para el  teacher
const Index_teacher = () => import("./components/teacher/Index.vue");
const Create_teacher = () => import("./components/teacher/Create.vue");
const Edit_teacher = () => import("./components/teacher/Edit.vue");

//importamos los componentes para la persona
const Index_person = () => import("./components/person/Index.vue");
const Create_person = () => import("./components/person/Create.vue");
const Edit_person = () => import("./components/person/Edit.vue");

//componentes pagos

const Index_pay = () => import("./components/pays/Index.vue");
const Pendientes = () => import("./components/classes/Pendientes.vue");

export const routes = [

    {
        name: "home",
        path: "/",
        component: Home
    },
    {
        name: "listado",
        path: "/listado",
        component: Listado
    },
    {
        name: "modal",
        path: "/Modal",
        component: Modal
    },
    {
        name: "indexSchedule",
        path: "/schedules",
        component: Index_schedule
    },
    {
        name: "createSchedule",
        path: "/createSchedule",
        component: Create_schedule
    },
    {
        name: "editSchedule",
        path: "/edit/:id",
        component: Edit_schedule
    },

    //Rutas de teachers

    {
        name: "indexTeacher",
        path: "/teachers",
        component: Index_teacher
    },
    {
        name: "createTeacher",
        path: "/createTeacher",
        component: Create_teacher
    },
    {
        name: "editTeacher",
        path: "/editTeacher/:id",
        component: Edit_teacher
    },

    //Rutas de Personas

    {
        name: "indexPerson",
        path: "/persons",
        component: Index_person
    },
    {
        name: "createPerson",
        path: "/createPerson",
        component: Create_person
    },
    {
        name: "editPerson",
        path: "/editPerson/:id",
        component: Edit_person
    },

    //Rutas pagos

    {
        name: "indexPay",
        path: "/pays",
        component: Index_pay
    },
    {
        name: "indexPendientes",
        path: "/pendientes",
        component: Pendientes
    }
];
