<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-book"></i> Les exercices
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Ajouter Cour</a>
          </li>
        </ol>
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <button
        type="button"
        data-toggle="modal"
        data-target=".bd-example-modal-lg"
        data-placement="top"
        class="btn btn-primary btn-rounded mb-3"
      >
        <i class="fa fa-plus color-primary"></i>&ensp;Ajouter cours
      </button>
    </div>
    <!-- Large modal ajouter cours -->
    <!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter Cour</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark">Cycle</label>
                  <select
                    class="form-control form-control"
                    @change="GetGrades(IdCyle)"
                    v-model="IdCyle"
                    required
                  >
                    <option
                      v-for="(item,index) in Cycles"
                      :key="index"
                      :value="item.id"
                    >{{ item.name }}</option>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Niveau</label>
                  <select
                    class="form-control form-control"
                    @change="GetClass(FormCours.grade_id)"
                    v-model="FormCours.grade_id"
                    required
                  >
                    <option
                      v-for="(item,index) in GradesName"
                      :key="index"
                      :value="item.id"
                    >{{ item.name }}</option>
                  </select>
                </div>
              </div>
              <div class="row mt-2" v-if="ActiveForm">
                <div class="col-lg-6">
                  <label class="text-dark">Option</label>
                  <select class="form-control form-control" v-model="FormCours.option_id">
                    <option
                      v-for="(item,index) in Subjects"
                      :key="index"
                      :value="item.id"
                    >{{ item.nameOption }}</option>
                  </select>
                </div>
                <div class="col-lg-6" v-if="IdCyle==3 && ActiveForm">
                  <label class="text-dark">branche</label>
                  <select class="form-control form-control" v-model="FormCours.branch_id">
                    <option
                      v-for="(item,index) in BranchesName"
                      :key="index"
                      :value="item.id"
                    >{{ item.name }}</option>
                  </select>
                </div>
              </div>
              <div class="row mt-2" v-if="ActiveForm">
                <div class="col-lg-6">
                  <label class="text-dark">Nom de cour</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="FormCours.nameCourse"
                    id="val-namecourse"
                    name="val-namecourse"
                  >
                </div>
                <div class="col-lg-6">
                  <label class="text-dark" for="exampleFormControlTextarea1">Description</label>
                  <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    v-model="FormCours.descriptionCourse"
                    rows="2"
                  ></textarea>
                </div>
              </div>
              <div class="row mt-2" v-if="ActiveForm">
                <div class="col-lg-6">
                  <label class="text-dark">Ficher</label>
                  <input
                    type="file"
                    class="form-control"
                    id="file"
                    ref="file"
                    v-on:change="handleFileUpload()"
                  >
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Session cour</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="FormCours.sessionCourse"
                    id="val-session"
                    name="val-session"
                  >
                </div>
              </div>
              <div class="row mt-2" v-else>
                <div class="col-lg-12">
                  <div
                    class="alert alert-danger"
                    role="alert"
                  >Vous avez aucun classe affecté dans ce Niveau</div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-times"></i>&ensp;Annuler
            </button>
            <button
              v-if="ActiveForm"
              @click="CreateCourse"
              data-dismiss="modal"
              type="button"
              class="btn btn-primary"
            >
              <i class="fa fa-plus color-primary"></i>&ensp;Ajouter
            </button>
          </div>
        </div>
      </div>
    </div>-->

    <!-- Large modal edit L'absence teacher -->
    <div class="modal fade bd-absence-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier l'absense</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark">Cour</label>
                  <input
                    type="text"
                    disabled="disabled"
                    style="background-color:#40404024"
                    class="form-control"
                    v-model="FormCours.nameCourse"
                    id="val-namegrade"
                    name="val-namegrade"
                  >
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Exercice</label>
                  <input
                    type="text"
                    v-model="FormExercice.nameExercice"
                    class="form-control"
                    id="val-nameoption"
                    name="val-nameoption"
                  >
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark" for="exampleFormControlTextarea1">Description</label>
                  <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    v-model="FormExercice.descriptionExercice"
                    rows="2"
                  ></textarea>
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
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-times"></i>&ensp;Annuler
            </button>
            <button
              type="button"
              @click="CreateExercice"
              class="btn btn-primary"
              data-dismiss="modal"
            >
              <i class="fa fa-plus color-primary"></i>&ensp;Ajouter
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Les cours</h4>
          </div>
          <div class="card-body">
            <div>
              <div class="float-right mb-3">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                      <i class="fas fa-search"></i>
                    </span>
                  </div>
                  <input
                    type="text"
                    placeholder="Cour....."
                    v-model="TitleCourse"
                    class="form-control"
                    id="val-titlecourse"
                    name="val-titlecourse"
                    @keyup="GetCourseByTitle"
                    aria-describedby="basic-addon1"
                  >
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm"
                style="color:black"
              >
                <thead>
                  <tr>
                    <th scope="col">Name Course</th>
                    <th scope="col">Description</th>
                    <th scope="col">Session course</th>
                    <th scope="col">Course</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in AllCourses" :key="index">
                    <td>{{ item.nameCourse }}</td>
                    <td>{{ item.descriptionCourse }}</td>
                    <td>{{ item.sessionCourse }}</td>
                    <td>
                      <!-- {{ item.fileCourse }} -->

                      <a :href="'/'+item.fileCourse">
                        <span class="badge badge-primary">
                          <i class="fas fa-download"></i>
                          <span>Telecharger</span>
                        </span>
                      </a>
                    </td>
                    <td>{{ item.nameGrade }}</td>
                    <td>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="modal"
                          data-target=".bd-absence-modal-lg"
                          data-placement="top"
                          title="Edit"
                          @click="EditeCour(item.id)"
                        >
                          <span class="badge badge-primary">
                            <i class="fa fa-plus color-primary"></i>
                            <span>&ensp;Ajouter exercice</span>
                          </span>
                        </a>
                      </span>
                      <a
                        href="javascript:void()"
                        class="mr-4"
                        title="Edit"
                        @click="EditeCour(item.id)"
                      >
                        <span class="badge badge-info">
                          <i class="fas fa-eye"></i>
                          <span>&ensp;Les exercices</span>
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

    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">les exercices de cour : {{ FormCours.nameCourse }}</h4>
          </div>
          <div class="card-body">
            <!-- ->> {{ CourExercices }} -->
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm text-center"
                style="color:black;"
              >
                <thead>
                  <tr>
                    <th scope="col">Name Exercice</th>
                    <th scope="col">Description</th>
                    <th scope="col">Exercice</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in CourExercices" :key="index">
                    <td>{{ item.nameExercice }}</td>
                    <td>{{ item.descriptionExercice }}</td>
                    <td>
                      <!-- {{ item.fileCourse }} -->

                      <a :href="'/'+item.fileExercice">
                        <span class="badge badge-primary">
                          <i class="fas fa-download"></i>
                          <span>Telecharger</span>
                        </span>
                      </a>
                    </td>
                    <td width="24%" class>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="modal"
                          data-target=".bd-absence-modal-lg"
                          data-placement="top"
                          title="Edit"
                          @click="EditeCour(item.id)"
                        >
                          <span class="badge badge-primary">
                            <i class="fa fa-plus color-primary"></i>
                            <span>&ensp;Ajouter exercice</span>
                          </span>
                        </a>
                        <a
                          href="javascript:void()"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Close"
                          @click="DeleteExercice(item.id)"
                        >
                          <span class="badge badge-danger">
                            <i class="far fa-trash-alt"></i>
                            <span>&ensp;Supprimer</span>
                          </span>
                        </a>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row" v-if="ActiveTable">
                <div class="col-lg-12">
                  <h4 class="d-flex justify-content-center">Aucun exercices</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      IdCyle: "",
      TitleCourse: "",
      GradesName: [],
      Cycles: [],
      Subjects: [],
      Classes: [],
      BranchesName: [],
      CourExercices: [],
      AllCourses: [],
      ActiveTable: true,
      CourseExercice: new FormData(),
      FormExercice: {
        nameExercice: "",
        descriptionExercice: "",
        fileExercice: "",
        course_id: ""
      },
      FormCours: {
        id: "",
        nameCourse: "",
        descriptionCourse: "",
        fileCourse: "",
        sessionCourse: "",
        grade_id: "",
        branch_id: "",
        option_id: ""
      }
    };
  },
  methods: {
    EditeCour(idCourse) {
      this.FormCours = [];
      axios.get("course/" + idCourse).then(response => {
        if (response.data["status"] == "success") {
          this.FormCours = response.data["course"];
          this.FormExercice.course_id = this.FormCours.id;
          this.ShowExerices();
        }
      });
    },
    GetCourseByTitle() {
      this.AllCourses = [];
      if (this.TitleCourse.length == 0) {
        this.ShowCourses();
      } else {
        axios.get("course/title/" + this.TitleCourse).then(response => {
          if (response.data["status"] == "success") {
            this.AllCourses = response.data["courses"];
          }
        });
      }
    },

    handleFileUpload() {
      this.FormExercice.fileExercice = this.$refs.file.files[0];
      // console.log(this.Timetables.File);
    },
    CreateExercice() {
      const config = { headers: { "Content-Type": "multipart/form-data" } };
      this.CourseExercice.append(
        "nameExercice",
        this.FormExercice.nameExercice
      );
      this.CourseExercice.append(
        "descriptionExercice",
        this.FormExercice.descriptionExercice
      );
      this.CourseExercice.append(
        "fileExercice",
        this.FormExercice.fileExercice
      );
      this.CourseExercice.append("course_id", this.FormExercice.course_id);

      axios
        .post("exercice", this.CourseExercice, config)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "Exercice a été enregistré",
              showConfirmButton: true
            });
            this.EditeCour(this.FormCours.id);
            this.ShowExerices();
            this.FormExercice = [];
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
          }
        });
    },
    ShowCourses() {
      (this.AllCourses = []),
        axios.get("/course").then(response => {
          if (response.data["status"] == "success") {
            this.AllCourses = response.data["course"];
            //   console.log(this.GradesName);
          }
        });
    },
    ShowExerices() {
      (this.CourExercices = []),
        axios
          .get("/course/exercices/" + this.FormExercice.course_id)
          .then(response => {
            if (response.data["status"] == "success") {
              this.CourExercices = response.data["exercices"];
              if (this.CourExercices.length == 0) {
                this.ActiveTable = true;
              } else this.ActiveTable = false;
              //   alert("og");
              //   console.log(this.CourExercices.nameExercice);
            }
          });
    },
    DeleteExercice(idExerice) {
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
          axios.post("exercice/" + idExerice + "/trash").then(response => {
            if (response.data["status"] == "success") {
              this.ShowExerices();
            }
          });
          Swal.fire("Supprimé!", "le cour a été supprimé.", "success");
        }
      });
    },

    UpdateAbsenceTeacher() {
      axios
        .post(
          "/update/teacher/absence/" + this.IdTeacherAbsence,
          this.AbsenceTeacher
        )
        .then(response => {
          if (response.data["status"] == "success") {
            this.GetAbsencesTeacher();
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "la classe a été affecter",
              showConfirmButton: true
            });
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
    }
  },
  created() {
    this.ShowCourses();
  }
};
</script>