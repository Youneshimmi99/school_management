<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, {{ AdminActive["name"] }}</h4>
          <p class="mb-0">{{ AdminActive["email"] }}</p>
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
              <i class="fas fa-chalkboard-teacher"></i>
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
              <i class="fas fa-user-graduate"></i>
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
              <i class="fab fa-buromobelexperte"></i>
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
              <i class="fas fa-users-cog"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Admins</div>
              <div class="stat-digit">{{ countadmin }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col">
                <v-chart class="chart" :option="option"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="row chart">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Professeur En ligne</h4>
              </div>
              <div class="card-body ex1">
                <div class="basic-list-group">
                  <ul class="list-group tailleListe">
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center"
                      v-for="(item,index) in Teachers"
                      :key="index"
                    >
                      {{ item.name }}
                      <span class="badge badge-success badge-pill">En ligne</span>
                    </li>
                  </ul>
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
          <div class="card-body">
            <highcharts :options="chartOptions"></highcharts>
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
// import charts from "./charts";
import HighchartsVue from "highcharts-vue";
import { Chart } from "highcharts-vue";
import "echarts";
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { PieChart } from "echarts/charts";
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
  CanvasRenderer,
  PieChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent
]);
export default {
  name: "HelloWorld",
  components: {
    VChart,
    highcharts: Chart
  },
  provide: {
    [THEME_KEY]: "white"
  },
  data() {
    return {
      CountTechers: 0,
      CountStudent: 0,
      countadmin: 0,
      femaleStudent: 0,
      CountClasse: 0,
      gradeClasses: [],
      Teachers: [],
      SubClasse: [],
      SubjectTeacher: 0,
      AdminActive: [],
      chartOptions: {
        series: [
          {
            data: [1, 2, 3] // sample data
          }
        ]
      },
      option: {
        title: {
          text: "Les Classes",
          left: "center"
        },
        tooltip: {
          trigger: "item",
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          orient: "vertical",
          left: "left",
          data: [
            "première année collége",
            "deuxième année collège",
            "troisième année collège",
            "tronc commun",
            "première année bac",
            "deuxième année bac"
          ]
        },
        series: [
          {
            name: "Les Classes",
            type: "pie",
            radius: "55%",
            center: ["50%", "60%"],
            data: [
              {
                value: 23,
                name: "première année collége"
              },
              {
                value: 34,
                name: "deuxième année collège"
              },
              {
                value: 23,
                name: "troisième année collège"
              },
              {
                value: 53,
                name: "tronc commun"
              },
              {
                value: 23,
                name: "première année bac"
              },
              {
                value: 54,
                name: "deuxième année bac"
              }
            ],
            emphasis: {
              itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: "rgba(0, 0, 0, 0.5)"
              }
            }
          }
        ]
      }
    };
  },
  methods: {
    GetTeachers() {
      this.Teachers = [];
      axios.get("/teachers").then(response => {
        if (response.data["status"] == "success") {
          this.Teachers = response.data["teachers"];
        }
      });
    },
    getAdminActive() {
      axios.get("/adminactive").then(response => {
        if (response.data["status"] == "success") {
          this.AdminActive = response.data["adminactive"];
        }
      });
    },
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
    CountAdmins() {
      axios.get("/alladmin").then(response => {
        if (response.data["status"] == "success") {
          this.countadmin = response.data["countadmin"];
        }
      });
    },
    // FemaleStudents() {
    //   axios.get("/femaleStudents").then(response => {
    //     if (response.data["status"] == "success") {
    //       this.femaleStudent = response.data["femaleStudents"];
    //     }
    //   });
    // },
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
          this.gradeClasses = response.data["classes"];
        }
      });
    },
    SubjectTeachers() {
      axios.get("/subjectsTeachers").then(response => {
        if (response.data["status"] == "success") {
          this.SubClasse = response.data["teachers"];
        }
      });
    }
  },
  created() {
    // this.remplirData();
    this.SubjectTeachers();
    this.AllGradesClasse();
    this.Allclasses();
    this.CountAdmins();
    this.CountStudents();
    this.AllTeacher();
    this.getAdminActive();
    this.GetTeachers();
  }
};
</script>
