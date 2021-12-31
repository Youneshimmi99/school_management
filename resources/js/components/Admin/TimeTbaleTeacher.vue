<template>
  <div>
    <!-- Large modal ajouter classe -->
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
            <div class="needs-validation" novalidate v-if="!ShowModalTimeTable==0">
              <div class="row mb-3">
                <div class="col-lg-6">
                  <label class="text-dark">Nom L'emploi de temps</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="Timetables.NameTimeTable"
                    id="val-timetable"
                    name="val-timetable"
                    placeholder="Nom L'emploi de temps"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Ficher</label>
                  <input
                    type="file"
                    class="form-control"
                    id="file"
                    ref="file"
                    v-on:change="handleFileUpload()"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
              <!-- <div class="row mb-3">
                <div class="col-lg-6">
                  <label class="text-dark">Niveau</label>

                  <select class="form-control form-control" v-model="IdClasse">
                    <option
                      v-for="(item,index) in TeachersCla"
                      :key="index"
                      :value="item.id"
                    >{{ item.nameClasse }}</option>
                  </select>
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>-->
              <div class="row mt-3 mb-3" v-if="TeacherClasses">
                <div class="col-lg-6">
                  <div>
                    <label
                      style="color:black;"
                    >Les classes affecté au ce professeur : {{ FromProf.name }}</label>
                  </div>
                  <table
                    class="table-bordered verticle-middle table-responsive-sm"
                    style="color:black;text-align:center;"
                  >
                    <tr>
                      <td v-for="(item,index) in TeacherClasses" :key="index">{{ item.nameClasse }}</td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-6">
                  <label class="text-dark">Nom et Prenom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="val-username"
                    name="val-username"
                    v-model="FromProf.name"
                    disabled="disabled"
                    style="background-color:#40404024"
                    placeholder="Saisie nom et prenom.."
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Email</label>
                  <input
                    type="email"
                    v-model="FromProf.email"
                    class="form-control"
                    id="val-email"
                    style="background-color:#40404024"
                    name="val-email"
                    disabled
                    placeholder="Saisie l'email"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-lg-6">
                  <label class="text-dark">Tele</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="FromProf.tele"
                    id="val-username"
                    name="val-username"
                    style="background-color:#40404024"
                    placeholder="tele"
                    disabled
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Matière</label>

                  <select
                    class="form-control form-control"
                    v-model="FromProf.subject_id"
                    style="background-color:#40404024"
                    disabled
                  >
                    <option
                      v-for="(item,index) in Subjects"
                      :key="index"
                      :value="item.id"
                    >{{ item.namesub }}</option>
                  </select>
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
            </div>
            <div v-else>
              <h3>aucun classes affectées au ce professeur !</h3>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="AjouerEmploi(FromProf.id)"
            >Ajouter</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Ajouter l'emploi de temps</h4>
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
                    <th scope="col">Classes</th>
                    <th scope="col">L'emploi de temps</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Teachers" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.namesub }}</td>
                    <td>
                      <span v-for="(item2,index2) in TechearClasse" :key="index2">
                        <span v-if="item2.teacher_id==item.id">{{ item2.nameClasse }} &ensp;</span>
                      </span>
                    </td>
                    <td>
                      <a
                        href="javascript:void()"
                        data-toggle="modal"
                        data-target=".bd-example-modal-lg"
                        data-placement="top"
                        @click="GetClassesTeacher(item.id)"
                      >
                        <!-- <i class="fas fa-cloud-upload"></i> -->
                        <!-- <span class="badge badge-info">
                          <i class="far fa-download"></i>
                          <span>&ensp;</span>
                        </span>-->
                        <span class="badge badge-info">
                          <i class="fas fa-upload"></i>
                          <span>&ensp;Upload l'empoi de temps</span>
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
      timetables: new FormData(),
      Subjects: [],
      Cycles: [],
      GradesName: [],
      ClasseProf: [],
      BranchesName: [],
      TeachersCla: [],
      TeacherClasses: [],
      Classes: [],
      Teachers: [],
      TeachersIdit: [],
      ShowModalTimeTable: 0,
      IdCyle: "",
      IdGrade: "",
      IdClasse: "",
      Grades: [],
      TechearClasse: [],
      Timetables: {
        File: "",
        NameTimeTable: ""
      },
      FromProf: {
        name: "",
        subject_id: "",
        email: "",
        tele: "",
        password: "",
        password2: ""
      },

      inputs: [
        {
          name: ""
        }
      ]
    };
  },
  methods: {
    add(index) {
      this.inputs.push({ name: "" });
    },
    remove(index) {
      this.inputs.splice(index, 1);
    },
    GitViewAddTechear() {
      this.spinner = true;
      setTimeout(() => {
        this.spinner = false;
        this.addadmin = true;
      }, 700);
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
      this.TechearClasse = [];
      axios.get("/teachersWithoutTimetable").then(response => {
        if (response.data["status"] == "success") {
          this.Teachers = response.data["teachers"];
          this.TechearClasse = response.data["teachers_classes"];
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

    handleFileUpload() {
      this.Timetables.File = this.$refs.file.files[0];
      console.log(this.Timetables.File);
    },
    AjouerEmploi(idTeacher) {
      const config = { headers: { "Content-Type": "multipart/form-data" } };
      this.timetables.append("file", this.Timetables.File);
      this.timetables.append("nameTimetable", this.Timetables.NameTimeTable);
      this.timetables.append("teacher_id", this.FromProf.id);
      axios
        .post("/timetable", this.timetables, config)
        .then(response => {
          if (response.data["status"] == "success") {
            this.GetTeachers();
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'emploi de temps a été enregistré",
              showConfirmButton: true
            });
          }
        })
        .catch(error => {
          if (error.response.status == 422) {
            // this.errors = error.response.data.errors;
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Error !",
              text: "Tous les champs c'est obligatoire !",
              showConfirmButton: true
            });
            // this.FromProf = [];
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
