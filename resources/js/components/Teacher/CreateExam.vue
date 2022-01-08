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
            <a href="javascript:void(0)">Ajouter examen</a>
          </li>
        </ol>
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <!-- <button
        type="button"
        data-toggle="modal"
        data-target=".bd-example-modal-lg"
        data-placement="top"
        class="btn btn-primary btn-rounded mb-3"
      >
        <i class="fa fa-plus color-primary"></i>&ensp;Ajouter cours
      </button>-->
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
            <h5 class="modal-title">Ajouter examen</h5>
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
                  <label class="text-dark">Niveau</label>
                  <select
                    class="form-control"
                    disabled="disabled"
                    style="background-color:#40404024"
                  >
                    <option>{{ VarHelp.grade }}</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark">Option</label>
                  <select
                    class="form-control"
                    disabled="disabled"
                    style="background-color:#40404024"
                  >
                    <option>{{ VarHelp.ooption }}</option>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Branch</label>
                  <select
                    class="form-control form-control"
                    disabled="disabled"
                    style="background-color:#40404024"
                  >
                    <option>{{ VarHelp.branch }}</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark">Examen</label>
                  <input
                    type="text"
                    v-model="FormExam.nameExam"
                    class="form-control"
                    id="val-nameoption"
                    name="val-nameoption"
                  >
                </div>
                <div class="col-lg-6">
                  <label class="text-dark" for="exampleFormControlTextarea1">Description</label>
                  <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    v-model="FormExam.descriptionExam"
                    rows="2"
                  ></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark">Session examen</label>
                  <input
                    type="text"
                    v-model="FormExam.sessionExam"
                    class="form-control"
                    id="val-nameoption"
                    name="val-nameoption"
                  >
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
              @click="CreateExamen"
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
            <h4 class="card-title">les examens</h4>
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
                            <span>&ensp;Ajouter examen</span>
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
                          <span>&ensp;Les examens</span>
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
            <h4 class="card-title">les examens de cour : {{ FormCours.nameCourse }}</h4>
          </div>
          <div class="card-body">
            <!-- ->> {{ CourExamens }} -->
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm text-center"
                style="color:black;"
              >
                <thead>
                  <tr>
                    <th scope="col">Name Exam</th>
                    <th scope="col">Description</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Session</th>
                    <th scope="col">Exam</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in CourExamens" :key="index">
                    <td>{{ item.nameExam }}</td>
                    <td>{{ item.descriptionExam }}</td>
                    <td>{{ item.nameGrade }}</td>
                    <td>{{ item.sessionExam }}</td>
                    <td>
                      <!-- {{ item.fileCourse }} -->

                      <a :href="'/'+item.fileExam">
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
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Close"
                          @click="DeleteExam(item.id)"
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
                  <h4 class="d-flex justify-content-center">Aucun Examens</h4>
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
      VarHelp: {
        grade: "",
        branch: "",
        ooption: ""
      },
      Classes: [],
      BranchesName: [],
      CourExamens: [],
      AllCourses: [],
      GradesName: [],
      ActiveTable: true,

      CourseExamen: new FormData(),
      FormExam: {
        nameExam: "",
        descriptionExam: "",
        fileExam: "",
        sessionExam: "",
        grade_id: "",
        branch_id: "",
        option_id: "",
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
    gitGrade() {
      // this.VarHelp=[];
      (this.VarHelp.grade = ""),
        (this.VarHelp.ooption = ""),
        (this.VarHelp.branch = ""),
        axios
          .get(
            "getgrade/" +
              this.FormExam.grade_id +
              "/" +
              this.FormExam.branch_id +
              "/" +
              this.FormExam.option_id
          )
          .then(response => {
            if (response.data["status"] == "success") {
              this.VarHelp.grade = response.data["grade"]["nameGrade"];
              this.VarHelp.ooption = response.data["option"]["nameOption"];
              this.VarHelp.branch = response.data["branch"]["nameBranch"];
            }
          });
    },
    EditeCour(idCourse) {
      this.FormCours = [];
      axios.get("course/" + idCourse).then(response => {
        if (response.data["status"] == "success") {
          this.FormCours = response.data["course"];
          this.FormExam.grade_id = this.FormCours.grade_id;
          this.FormExam.branch_id = this.FormCours.branch_id;
          this.FormExam.option_id = this.FormCours.option_id;
          this.FormExam.course_id = this.FormCours.id;
          this.gitGrade();
          this.ShowExamens();
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
      this.FormExam.fileExam = this.$refs.file.files[0];
      // console.log(this.Timetables.File);
    },
    CreateExamen() {
      const config = { headers: { "Content-Type": "multipart/form-data" } };
      this.CourseExamen.append("nameExam", this.FormExam.nameExam);
      this.CourseExamen.append(
        "descriptionExam",
        this.FormExam.descriptionExam
      );
      this.CourseExamen.append("fileExam", this.FormExam.fileExam);
      this.CourseExamen.append("sessionExam", this.FormExam.sessionExam);
      this.CourseExamen.append("grade_id", this.FormExam.grade_id);
      this.CourseExamen.append("branch_id", this.FormExam.branch_id);
      this.CourseExamen.append("option_id", this.FormExam.option_id);
      this.CourseExamen.append("course_id", this.FormExam.course_id);

      axios
        .post("exam", this.CourseExamen, config)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "Examen  a été enregistré",
              showConfirmButton: true
            });
            this.EditeCour(this.FormCours.id);
            this.ShowExamens();
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
    ShowExamens() {
      (this.CourExamens = []),
        axios.get("/exam/" + this.FormCours.id).then(response => {
          if (response.data["status"] == "success") {
            this.CourExamens = response.data["examcourse"];
            if (this.CourExamens.length == 0) {
              this.ActiveTable = true;
            } else this.ActiveTable = false;
            //   alert("og");
            //   console.log(this.CourExercices.nameExercice);
          }
        });
    },
    DeleteExam(idexam) {
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
          axios.post("exam/" + idexam + "/trash").then(response => {
            if (response.data["status"] == "success") {
              this.ShowExamens();
            }
          });
          Swal.fire("Supprimé!", "Exam a été supprimé.", "success");
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