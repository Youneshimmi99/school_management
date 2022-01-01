<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, welcome back!</h4>
          <p class="mb-0">Your business dashboard template</p>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Layout</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Blank</a>
          </li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="ti-money text-success border-success"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Professeurs</div>
              <div class="stat-digit">{{ CountTechers }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="ti-user text-primary border-primary"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Les élèves</div>
              <div class="stat-digit">{{ CountStudent }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="ti-layout-grid2 text-pink border-pink"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Les classes</div>
              <div class="stat-digit">{{ CountClasse }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="ti-link text-danger border-danger"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Admins</div>
              <div class="stat-digit">{{ }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Fee Collections and Expenses</h4>
          </div>
          <div class="card-body">
            <div class="ct-bar-chart mt-5"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="ct-pie-chart"></div>
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
      CountTechers: 0,
      CountStudent: 0,
      countadmin: 0,
      femaleStudent: 0,
      CountClasse: 0,
      GradeClasse: 0,
      SubjectTeacher: 0
    };
  },
  methods: {
    AllTeacher() {
      axios.get("/allTeachers").then(response => {
        if (response.data["status"] == "success") {
          this.CountTechers = response.data["teachers"];
        }
      });
    },
    CountStudents() {
      axios.get("/allStudents").then(response => {
        if (response.data["status"] == "success") {
          this.CountStudent = response.data["students"];
        }
      });
    },
    CountAdmin() {
      axios.get("/alladmins").then(response => {
        if (response.data["status"] == "success") {
          this.countadmin = response.data["maleStudents"];
        }
      });
    },
    FemaleStudents() {
      axios.get("/femaleStudents").then(response => {
        if (response.data["status"] == "success") {
          this.femaleStudent = response.data["femaleStudents"];
        }
      });
    },
    Allclasses() {
      axios.get("/allClasses").then(response => {
        if (response.data["status"] == "success") {
          this.CountClasse = response.data["classes"];
        }
      });
    },
    AllGradesClasse() {
      axios.get("/gradesClasses").then(response => {
        if (response.data["status"] == "success") {
          this.CountClasse = response.data["classes"];
        }
      });
    },
    SubjectTeachers() {
      axios.get("/subjectsTeachers").then(response => {
        if (response.data["status"] == "success") {
          this.GradeClasse = response.data["teachers"];
        }
      });
    }
  },
  created() {
    this.SubjectTeachers();
    this.AllGradesClasse();
    this.Allclasses();
    this.CountAdmin();
    this.MaleStudents();
    this.CountStudents();
    this.AllTeacher();
  }
};
</script>
