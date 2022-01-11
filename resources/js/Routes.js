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
import AffectationClasses from "./components/Admin/AffectationClasses.vue";
import TimeTableClasse from "./components/Admin/TimeTableClasse.vue";
import TeacherAbsence from "./components/Admin/TeacherAbsence.vue";
import CreateCour from "./components/Teacher/CreateCour.vue";
import ArchiveCours from "./components/Teacher/ArchiveCours.vue";
import CreateExercice from "./components/Teacher/CreateExercice.vue";
import ArchiveExercice from "./components/Teacher/ArchiveExercices.vue";
import DashTeacher from "./components/Teacher/DashTeacher.vue";
import ArchiveExam from "./components/Teacher/ArchiveExam.vue";
import CreateExam from "./components/Teacher/CreateExam.vue";
import dashStudent from "./components/Student/DashStudent.vue";
import CoursAndExercices from "./components/Student/CoursAndExercices.vue";

const routes = [
    {
        path: "/cours",
        name: "cours",
        component: CreateCour
    },
    {
        path: "/cours/exercices",
        name: "execours",
        component: CoursAndExercices
    },
    {
        path: "/accueil/eleve",
        name: "elve",
        component: dashStudent
    },
    {
        path: "/professeur",
        name: "cours",
        component: DashTeacher
    },
    {
        path: "/exercices",
        name: "exercices",
        component: CreateExercice
    },
    {
        path: "/examens",
        name: "examens",
        component: CreateExam
    },
    {
        path: "/examens_archives",
        name: "examens_archives",
        component: ArchiveExam
    },
    {
        path: "/exercices_archives",
        name: "arexercice",
        component: ArchiveExercice
    },
    {
        path: "/archives_cours",
        name: "archives_cours",
        component: ArchiveCours
    },
    {
        path: "/accueil",
        name: "dash",
        component: Dashboard
    },
    {
        path: "/absence/prof",
        name: "absence_prof",
        component: TeacherAbsence
    },
    {
        path: "/timetable/classe",
        name: "timetaleclassse",
        component: TimeTableClasse
    },
    {
        path: "/affectation/classes",
        name: "affectationclasses",
        component: AffectationClasses
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
        path: "/archives_classes",
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
