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
    <!-- Large modal ajouter exam -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter Exam</h5>
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
                    @change="GetClass(FormExam.grade_id)"
                    v-model="FormExam.grade_id"
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
                  <select class="form-control form-control" v-model="FormExam.option_id">
                    <option
                      v-for="(item,index) in Subjects"
                      :key="index"
                      :value="item.id"
                    >{{ item.nameOption }}</option>
                  </select>
                </div>
                <div class="col-lg-6" v-if="IdCyle==3 && ActiveForm">
                  <label class="text-dark">branche</label>
                  <select class="form-control form-control" v-model="FormExam.branch_id">
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
                  <label class="text-dark">Nom examen</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="FormExam.nameExam"
                    id="val-namecourse"
                    name="val-namecourse"
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
                  <label class="text-dark">Session exam</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="FormExam.sessionExam"
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
              @click="CreateExamen"
              data-dismiss="modal"
              type="button"
              class="btn btn-primary"
            >
              <i class="fa fa-plus color-primary"></i>&ensp;Ajouter
            </button>
          </div>
        </div>
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">les examens primaire</h4>
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
                  <tr v-for="(item,index) in ExamensPrimaire" :key="index">
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">les examens collège</h4>
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
                  <tr v-for="(item,index) in ExamensCollege" :key="index">
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">les examens lycée</h4>
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
                    <th scope="col">Branch</th>
                    <th scope="col">Exam</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in ExamensLycee" :key="index">
                    <td>{{ item.nameExam }}</td>
                    <td>{{ item.descriptionExam }}</td>
                    <td>{{ item.nameGrade }}</td>
                    <td>{{ item.sessionExam }}</td>
                    <td>{{ item.nameBranch }}</td>
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
      ActiveForm: false,
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
      },
      ExamensPrimaire: [],
      ExamensCollege: [],
      ExamensLycee: []
    };
  },
  methods: {
    ShowExamensPrimaire() {
      (this.ExamensPrimaire = []),
        axios.get("/exam/primaire/teacher").then(response => {
          if (response.data["status"] == "success") {
            this.ExamensPrimaire = response.data["teacherexam"];
            if (this.ExamensPrimaire.length == 0) {
              this.ActiveTable = true;
            } else this.ActiveTable = false;
            //   alert("og");
            //   console.log(this.CourExercices.nameExercice);
          }
        });
    },
    ShowExamensCollege() {
      (this.ExamensCollege = []),
        axios.get("/exam/college/teacher").then(response => {
          if (response.data["status"] == "success") {
            this.ExamensCollege = response.data["teacherexam"];
            if (this.ExamensCollege.length == 0) {
              this.ActiveTable = true;
            } else this.ActiveTable = false;
            //   alert("og");
            //   console.log(this.CourExercices.nameExercice);
          }
        });
    },
    ShowExamensLycee() {
      (this.ExamensLycee = []),
        axios.get("/exam/lycee/teacher").then(response => {
          if (response.data["status"] == "success") {
            this.ExamensLycee = response.data["teacherexam"];
            // if (this.ExamensLycee.length == 0) {
            //   this.ActiveTable = true;
            // } else this.ActiveTable = false;
            //   alert("og");
            //   console.log(this.CourExercices.nameExercice);
          }
        });
    },
    GetSubjects() {
      this.Subjects = [];
      axios.get("/subjects").then(response => {
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
      axios.get("/grades/" + item).then(response => {
        if (response.data["status"] == "success") {
          this.GradesName = response.data["gradesname"];
          //   console.log(this.GradesName);
        }
      });
    },
    GetClass(IdGrade) {
      // alert(IdGrade);

      this.Classes = [];
      axios.get("/getclassesbyprof/" + IdGrade).then(response => {
        if (response.data["status"] == "success") {
          this.Classes = response.data["teachers_classes"];
          this.GetBranchs();
          // console.log(this.Classes.length);
          if (!this.Classes.length == 0) {
            this.ActiveForm = true;
          } else this.ActiveForm = false;

          // alert(this.Classes);
        }
      });
    },
    GetBranchs() {
      this.BranchesName = [];
      axios.get("/branches/" + this.FormExam.grade_id).then(response => {
        if (response.data["status"] == "success") {
          this.BranchesName = response.data["branchesnames"];
          //   console.log(this.GradesName);
        }
      });
    },
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
        }
      });
    },
    GetCourseByTitle() {
      this.AllCourses = [];
      if (this.TitleCourse.length == 0) {
        this.ShowExam();
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

            this.ShowExamensPrimaire();
            this.ShowExamensCollege();
            this.ShowExamensLycee();
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
    // ShowExam() {
    //   (this.AllCourses = []),
    //     axios.get("/course").then(response => {
    //       if (response.data["status"] == "success") {
    //         this.AllCourses = response.data["course"];
    //         //   console.log(this.GradesName);
    //       }
    //     });
    // },

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
              this.ShowExamensPrimaire();
              this.ShowExamensCollege();
              this.ShowExamensLycee();
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
    this.ShowExamensPrimaire();
    this.ShowExamensCollege();
    this.ShowExamensLycee();
    this.GetCycles();
    this.GetSubjects();
  }
};
</script>