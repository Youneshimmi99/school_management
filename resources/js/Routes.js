import Dashboard from "./components/Admin/DashboardAdmin.vue";
import NiveauAdmin from "./components/Admin/NiveauAdmin.vue";
import ViewNiveaux from "./components/Admin/ViewNiveaux.vue";
import AddTechear from "./components/Admin/AddTechear.vue";
import CreateClass from "./components/Admin/CreateClass.vue";
import ViewClass from "./components/Admin/ViewClass.vue";
import AddAdmin from "./components/Admin/AddAdmin.vue";
import AddStudent from "./components/Admin/AddStudent.vue";
import ArchiveClasse from "./components/Admin/ArchiveClasse.vue";
import AllTeacher from "./components/Admin/AllTeachers.vue";
import TimeTableTeahcer from "./components/Admin/TimeTbaleTeacher.vue";

const routes = [
    {
        path: "/accueil",
        name: "dash",
        component: Dashboard
    },
    {
        path: "/timetableteahcer",
        name: "TimeTableTeacer",
        component: TimeTableTeahcer
    },
    {
        path: "/professeurs",
        name: "professeurs",
        component: AllTeacher
    },
    {
        path: "/archives",
        name: "archive",
        component: ArchiveClasse
    },
    {
        path: "/ajouter_admin",
        name: "ajouter_admin",
        component: AddAdmin
    },
    {
        path: "/ajouter_eleve",
        name: "ajouter_eleve",
        component: AddStudent
    },
    {
        path: "/niveau",
        name: "nivaus",
        component: NiveauAdmin
    },
    {
        path: "/afficher_niveaux",
        name: "nivaus",
        component: ViewNiveaux
    },
    {
        path: "/ajouter_professeur",
        name: "ajouter_prof",
        component: AddTechear
    },
    {
        path: "/creer_classe",
        name: "creer_classe",
        component: CreateClass
    },
    {
        path: "/classes",
        name: "classes",
        component: ViewClass
    }
];

export default routes;
