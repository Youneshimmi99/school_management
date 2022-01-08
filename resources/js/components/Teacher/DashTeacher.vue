<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Hi, {{ TeacherActive["name"] }}</h4>
          <p class="mb-0">{{ TeacherActive["email"] }}</p>
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
              <div class="stat-text">Les cours</div>
              <div class="stat-digit">{{ countcourtechear }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="stat-widget-one card-body">
            <div class="stat-icon d-inline-block">
              <i class="far fa-file-alt"></i>
            </div>
            <div class="stat-content d-inline-block">
              <div class="stat-text">Les exercices</div>
              <div class="stat-digit">{{ counteexrcicetechear }}</div>
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
              <div class="stat-text">les examens</div>
              <div class="stat-digit">{{ countexamtechear }}</div>
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
              <div class="stat-digit">{{ countclasstechear }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-7">
        <div class="card">
          <div class="card-header">
            <!-- <h4 class="card-title">les professeurs de matière :</h4> -->
          </div>
          <div class="card-body">
            <!-- {{ SubClasse['informatique'] }} -->
            <div class>
              <!-- <apexchart type="line" width="520" :options="options" :series="series"></apexchart> -->
              <FullCalendar :options="calendarOptions"/>
            </div>
          </div>
        </div>
        <!-- <div class="card">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col">
                <v-chart class="chart" :option="option"/>
              </div>
            </div>
          </div>
        </div>-->
        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Info Professeur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row" v-for="(item,index) in teachermatiere" :key="index">
                  <div class="col-lg-4" v-if="item.id=idteacher">Nome et prenom : {{item.name }}</div>
                  <div class="col-lg-4" v-if="item.id=idteacher">Tele : {{item.tele }}</div>
                  <div class="col-lg-4" v-if="item.id=idteacher">Email : {{item.email }}</div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuller</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="row chart">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <!-- {{ teachermatiere }} -->
                <h4
                  class="card-title"
                >Les professeurs de matière : {{ teachermatiere[0]['namesub'] }}</h4>
              </div>
              <div class="card-body ex1">
                <div class="basic-list-group">
                  <ul class="list-group tailleListe">
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center"
                      v-for="(item,index) in teachermatiere"
                      :key="index"
                    >
                      {{ item.name }}
                      <span class="badge badge-secondary badge-pill">
                        <i class="fab fa-telegram-plane"></i>
                        &ensp;{{ item.tele }}
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-lg-5">
        <div class="card">
          <div class="card-body">
            <FullCalendar :options="calendarOptions"/>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">les matières et les professeurs</h4>
          </div>
          <div class="card-body">
       
            <div class="d-flex justify-content-center">
              <apexchart type="bar" width="520" :options="options" :series="series"></apexchart>
            </div>
          </div>
        </div>
      </div>
    </div>-->
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
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

import frLocale from "@fullcalendar/core/locales/fr";

// import charts from "./charts";
// import HighchartsVue from "highcharts-vue";
// import { Chart } from "highcharts-vue";
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
    FullCalendar

    // highcharts: Chart
  },
  provide: {
    [THEME_KEY]: "white"
  },
  data() {
    return {
      IdSubject: "",
      idteacher: "",
      showInfo: false,
      countcourtechear: 0,
      countclasstechear: 0,
      countexamtechear: 0,
      counteexrcicetechear: 0,
      TeacherActive: [],
      teachermatiere: [],

      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        locale: frLocale
      },
      options: {
        chart: {
          id: "vuechart-example"
        },
        xaxis: {
          categories: ["a", "b", "c", "d", "e", "f", "g", " f", "f f"]
        }
      },
      series: [
        {
          name: "Professeurs",
          data: [2, 3, 5, 2, 5, 2, 6, 2, 1]
        }
      ],
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
          data: ["a", "b", "c", "d", "e", "f"]
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
                name: "a"
              },
              {
                value: 34,
                name: "b"
              },
              {
                value: 23,
                name: "c"
              },
              {
                value: 53,
                name: "d"
              },
              {
                value: 23,
                name: "e"
              },
              {
                value: 54,
                name: "f"
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
    PlusInfo(idprof) {
      alert(idprof);
      this.idteacher = idprof;
      // alert(this.idteacher);
      thsi.showInfo = true;
    },
    GetCountCoursTeacher() {
      this.countcourtechear = [];
      axios.get("/getcountcour").then(response => {
        if (response.data["status"] == "success") {
          this.countcourtechear = response.data["countcourtechear"];
        }
      });
    },
    GetTeacherActive() {
      axios.get("/teacheractive").then(response => {
        if (response.data["status"] == "success") {
          this.TeacherActive = response.data["Teacheractive"];
          this.IdSubject = this.TeacherActive.id;
        }
      });
    },
    GetCountClasseTeacher() {
      axios.get("/getcountclassteacher").then(response => {
        if (response.data["status"] == "success") {
          this.countclasstechear = response.data["countclasstechear"];
        }
      });
    },
    GetCountexerciceTeacher() {
      axios.get("/getcountexerciceteacher").then(response => {
        if (response.data["status"] == "success") {
          this.counteexrcicetechear = response.data["counteexrcicetechear"];
        }
      });
    },
    GetCountexamTeacher() {
      axios.get("/getcountexamteacher").then(response => {
        if (response.data["status"] == "success") {
          this.countexamtechear = response.data["countexamtechear"];
        }
      });
    },
    GetTechearsMatiere() {
      axios.get("/getteachersmatiere").then(response => {
        if (response.data["status"] == "success") {
          this.teachermatiere = response.data["teachermatiere"];
        }
      });
    }
  },
  created() {
    this.GetCountCoursTeacher();
    this.GetTeacherActive();
    this.GetCountClasseTeacher();
    this.GetCountexerciceTeacher();
    this.GetCountexamTeacher();
    this.GetTechearsMatiere();
  }
};
</script>
