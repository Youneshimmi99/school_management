<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, {{ StudentActive.name }}</h4>
          <p class="mb-0">{{ StudentActive.email }}</p>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item">
            <a href="javascript:void(0)">ccueil</a>
          </li>-->
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Accueil</a>
          </li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="far fa-file-pdf"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Cycle</div>
              <div class="stat-digit">{{ StudentTimeTble[0]['name'] }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="far fa-file-alt"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Niveau</div>
              <div>
                <h4>{{ StudentTimeTble[0]['nameGrade'] }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="fas fa-edit"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Classe</div>
              <div class="stat-digit">{{ StudentTimeTble[0]['nameClasse'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-7">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Les Professeurs absencent</h4>
          </div>
          <div class="card-body ex1">
            <div class="table-responsive">
              <table class="table student-data-table m-t-20" style="color:black">
                <thead>
                  <tr>
                    <th>Professeur</th>
                    <th>Matiére</th>
                    <th>Date de début</th>
                    <th>Date fin</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in TeacherAbsence" :key="index">
                    <td>{{ item.name }}</td>
                    <td>{{ item.namesub }}</td>
                    <td>
                      <!-- <span class="badge badge-danger">Due</span> -->
                      {{ item.start_date }}
                    </td>
                    <td>{{ item.end_date }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="row chart">
          <div class="col">
            <div class="card">
              <div class="card-body text-center">
                <div class="m-t-10 mb4">
                  <h4 class="card-title">
                    <i class="fas fa-user-circle fa-4x"></i>
                  </h4>
                  <h6 class="mt-3">{{ StudentActive.name }}</h6>
                </div>
                <hr>
                <div class="row">
                  <div class="col-6">
                    <h6>Cycle :</h6>
                  </div>
                  <div class="col-6">
                    <h6>{{ StudentTimeTble[0]['name'] }}</h6>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-6">
                    <h6>Neveau :</h6>
                  </div>
                  <div class="col-6">
                    <h6>{{ StudentTimeTble[0]['nameGrade'] }}</h6>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-6">
                    <h6>Classe :</h6>
                  </div>
                  <div class="col-6">
                    <h6>{{ StudentTimeTble[0]['nameClasse'] }}</h6>
                  </div>
                </div>
                <hr>
                <div class="row mb-4" v-if="StudentTimeTble[0]['nameBranch']">
                  <div class="col-6">
                    <h6>Branch :</h6>
                  </div>
                  <div class="col-6">
                    <h6>{{ StudentTimeTble[0]['nameBranch'] }}</h6>
                  </div>
                </div>
                <div v-if="StudentTimeTble[0]['file']">
                  <a target="_blank" :href="'/'+StudentTimeTble[0]['file']" class="mr-4">
                    <span class="badge badge-secondary">
                      <i class="fas fa-download"></i>
                      <span>&ensp;Telecharger l'emploi du temps</span>
                    </span>
                  </a>
                </div>
                <div v-else>
                  <a class="mr-4">
                    <span class="badge badge-secondary">
                      <i class="fas fa-download"></i>
                      <span>&ensp;Aucun l'emploi du temps</span>
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <!-- <div class="card">
              <div class="card-header">
                <h4>L'emploi du temps</h4>
              </div>
              <div class="card-body">
                <a target="_blank" class="mr-4">
                  <span class="badge badge-secondary">
                    <i class="fas fa-download"></i>
                    <span>&ensp;Telecharger l'emploi du temps</span>
                  </span>
                </a>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
</script>

<style scoped>
.chart {
  height: 400px;
}
.ex1 {
  height: 380px;
  overflow: scroll;
}
</style>



<script>
export default {
  data() {
    return {
      StudentActive: [],
      StudentTimeTble: [],
      TeacherAbsence: []
    };
  },
  methods: {
    GetStudentClasse() {
      axios.get("/student/classe").then(response => {
        if (response.data["status"] == "success") {
          this.StudentActive = response.data["student"];
        }
      });
    },
    GetStudentTimeTable() {
      axios.get("/student_timetable/student").then(response => {
        if (response.data["status"] == "success") {
          this.StudentTimeTble = response.data["timetable"];
        }
      });
    },
    GetTeacherAbsence() {
      axios.get("/student/teachers/absences").then(response => {
        if (response.data["status"] == "success") {
          this.TeacherAbsence = response.data["teachers_absences"];
        }
      });
    }
  },
  created() {
    this.GetStudentClasse();
    this.GetStudentTimeTable();
    this.GetTeacherAbsence();
  }
};
</script>
