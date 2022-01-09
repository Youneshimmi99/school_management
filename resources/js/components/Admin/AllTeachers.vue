<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-chalkboard-teacher"></i> Listes des professeurs
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Professeurs</a>
          </li>
        </ol>
      </div>
    </div>
    <!-- Large modal edit teacher -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter L'emploi de temps Prof : {{ FromProf.name }}</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <img width="100%" height="35%" :src="'/'+this.TeleTimeTable">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <a target="_blank" :href="'/'+this.TeleTimeTable" class="btn btn-primary">Telecharger</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Les enseignants</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm"
                style="color:black;text-align:center;"
              >
                <thead>
                  <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Nom et prenom</th>
                    <th scope="col">Matière</th>
                    <th scope="col">L'emploi de temps</th>
                    <th scope="col">Status</th>
                    <th scope="col">L'emploi de temps</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Teachers" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.namesub }}</td>
                    <td>{{ item.nameTimetable }}</td>
                    <td>
                      <span class="badge badge-success">confirme</span>
                    </td>
                    <td>
                      <a
                        data-toggle="modal"
                        data-target=".bd-example-modal-lg"
                        data-placement="top"
                        class="mr-4"
                        title="telecharger"
                        @click="TelechargerTimeTableTeacher(item.id)"
                      >
                        <span class="badge badge-info">
                          <i class="fa fa-pencil"></i>
                          Telecharger
                        </span>
                      </a>

                      <a
                        href="javascript:void()"
                        class="mr-4"
                        title="Edit"
                        @click="DeleteTimeTable(item.id)"
                      >
                        <span class="badge badge-danger">
                          <i class="fa fa-pencil"></i>
                          Suprimmer
                        </span>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// ES6 Modules or TypeScript
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      addadmin: true,
      spinner: false,
      ShowModalTimeTable: 0,
      timetables: new FormData(),
      Subjects: [],
      Cycles: [],
      GradesName: [],
      ClasseProf: [],
      BranchesName: [],
      TeacherClasses: [],
      Classes: [],
      Teachers: [],
      TeachersIdit: [],
      IdCyle: "",
      IdGrade: "",
      IdClasse: "",
      Grades: [],
      TeleTimeTable: "",
      Timetables: {
        File: "",
        NameTimeTable: ""
      },
      FromProf: {
        name: "test1",
        subject_id: "",
        email: "sacascasc@gmail.com",
        tele: "34234324",
        password: "12345678",
        password2: "12345678"
      },

      inputs: [
        {
          name: ""
        }
      ]
    };
  },
  methods: {
    TelechargerTimeTableTeacher(IDTimeTableTeacher) {
      //   alert(IDTimeTableTeacher);
      this.TeleTimeTable = [];
      axios.get("/teacherTimetable/" + IDTimeTableTeacher).then(response => {
        if (response.data["status"] == "success") {
          this.TeleTimeTable = response.data["timetable"]["file"];
        }
      });
    },
    // downloadImg() {
    //   const url = window.URL.createObjectURL(new Blob([this.TeleTimeTable]));
    //   const link = document.createElement("a");
    //   link.href = url;
    //   link.setAttribute("download", this.TeleTimeTable); //or any other extension
    //   document.body.appendChild(link);
    //   link.click();
    // },
    GitViewAddTechear() {
      this.spinner = true;
      setTimeout(() => {
        this.spinner = false;
        this.addadmin = true;
      }, 700);
    },
    DeleteTimeTable(IdTimeTable) {
      Swal.fire({
        title: "Es-tu sûr?",
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Annuler",
        confirmButtonText: "Oui, supprimez-le !"
      }).then(result => {
        if (result.isConfirmed) {
          axios.post("/delete/emploi/" + IdTimeTable).then(response => {
            if (response.data["status"] == "success") {
              this.Teachers = [];
              this.GetTeachers();
            }
          });
          Swal.fire(
            "Supprimé!",
            "L'emploi de temps a été supprimé.",
            "success"
          );
        }
      });
    },
    GetSubjects() {
      this.Subjects = [];
      axios.get("/subjectsprof").then(response => {
        if (response.data["status"] == "success") {
          this.Subjects = response.data["subjects"];
        }
      });
    },
    GetCycles() {
      this.Cycles = [];
      axios.get("/cycles").then(response => {
        if (response.data["status"] == "success") {
          this.Cycles = response.data["cycles"];
        }
      });
    },
    GetGrades(item) {
      this.GradesName = [];

      axios.get("/grades/" + this.IdCyle).then(response => {
        if (response.data["status"] == "success") {
          this.GradesName = response.data["gradesname"];
          //   console.log(this.GradesName);
        }
      });
    },
    GetClass(IdGrade) {
      // alert(this.IdGrade);
      this.Classes = [];
      axios.get("/getclassesbyid/" + IdGrade).then(response => {
        if (response.data["status"] == "success") {
          this.Classes = response.data["classes"];
          // alert(this.Classes);
        }
      });
    },
    GetTeachers() {
      this.Teachers = [];
      axios.get("/teachers/emploidone").then(response => {
        if (response.data["status"] == "success") {
          this.Teachers = response.data["teachers"];
        }
      });
    },
    GetClassesTeacher(idTechear) {
      (this.FromProf.name = ""),
        (this.FromProf.subject_id = ""),
        (this.FromProf.email = ""),
        (this.FromProf.tele = ""),
        axios.get("/classes_teachers/" + idTechear).then(response => {
          if (response.data["status"] == "success") {
            this.TeacherClasses = response.data["teacher_classes"];
            this.ShowModalTimeTable = response.data["countTeacherClasses"];
            this.TeachersIdit = response.data["teachers"];
            this.FromProf.id = this.TeachersIdit.id;
            this.FromProf.name = this.TeachersIdit.name;
            this.FromProf.subject_id = this.TeachersIdit.subject_id;
            this.FromProf.email = this.TeachersIdit.email;
            this.FromProf.tele = this.TeachersIdit.tele;
            this.TeachersCla = response.data["classes_teacher"];
          }
        });
    },
    // EditTeacher(idTeacher) {
    //   (this.FromProf.name = ""),
    //     (this.FromProf.subject_id = ""),
    //     (this.FromProf.email = ""),
    //     (this.FromProf.tele = ""),
    //     axios.get("/teachers/edit/" + idTeacher).then(response => {
    //       if (response.data["status"] == "success") {
    //         this.TeachersIdit = response.data["teachers"];
    //         this.FromProf.id = this.TeachersIdit.id;
    //         this.FromProf.name = this.TeachersIdit.name;
    //         this.FromProf.subject_id = this.TeachersIdit.subject_id;
    //         this.FromProf.email = this.TeachersIdit.email;
    //         this.FromProf.tele = this.TeachersIdit.tele;
    //         this.teacher_classes = response.data["classes_teacher"];
    //       }
    //     });
    // },
    handleFileUpload() {
      this.Timetables.File = this.$refs.file.files[0];
      console.log(this.Timetables.File);
    },
    AjouerEmploi(idTeacher) {
      const config = { headers: { "Content-Type": "multipart/form-data" } };
      //   document.getElementById("val-ficher").value = [];

      this.timetables.append("file", this.Timetables.File);
      this.timetables.append("nameTimetable", this.Timetables.NameTimeTable);
      this.timetables.append("teacher_id", this.FromProf.id);
      this.timetables.append("classe_id", this.IdClasse);

      axios.post("/timetable", this.timetables, config).then(response => {
        if (response.data["status"] == "success") {
        }
      });
    },
    UpdateTeacher() {
      axios
        .post("/teachers/update", this.FromProf)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "modifié !",
              text: "L'enseignement a été modifier",
              showConfirmButton: false,
              timer: 1900
            });
            this.Teachers = [];
            this.GetTeachers();
            this.FromProf = [];
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
            this.FromProf = [];
          }
        })
        .catch(error => {
          if (error.response.status == 422) {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Error !",
              text: "Tous les champs c'est obligatoire !",
              showConfirmButton: true
            });
            this.FromProf = [];
          }
        });
    },
    DeleteTeacher(IdTeacher) {
      Swal.fire({
        title: "Es-tu sûr?",
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Annuler",
        confirmButtonText: "Oui, supprimez-le !"
      }).then(result => {
        if (result.isConfirmed) {
          axios.post("/delete/teacher/" + IdTeacher).then(response => {
            if (response.data["status"] == "success") {
              this.Teachers = [];
              this.GetTeachers();
            }
          });
          Swal.fire("Supprimé!", "L'enseignant a été supprimé.", "success");
        }
      });
    }
  },
  created() {
    this.GetSubjects();
    this.GetCycles();
    this.GetTeachers();
  }
};
</script>
