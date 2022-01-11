<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-folder"></i>
            &ensp;
            {{ Cycles[0]['name'] }} > {{ Cycles[0]['nameGrade'] }}
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Les cours</a>
          </li>
          <li class="breadcrumb-item active">
            <span>Les exercices</span>
          </li>
        </ol>
      </div>
    </div>
    <!-- Large modal edit L'absence teacher -->

    <!-- //////////////// -->

    <div>
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left"
                      type="button"
                      @click=" getCours(2)"
                      data-toggle="collapse"
                      data-target="#collapseOne"
                      aria-expanded="true"
                      aria-controls="collapseOne"
                    >
                      <h4>
                        <i class="fas fa-code"></i>&ensp;Informatique
                      </h4>
                    </button>
                  </h2>
                </div>

                <div
                  id="collapseOne"
                  class="collapse show"
                  aria-labelledby="headingOne"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(1)"
                      data-toggle="collapse"
                      data-target="#collapseTwo"
                      aria-expanded="false"
                      aria-controls="collapseTwo"
                    >
                      <h4>
                        <i class="fas fa-square-root-alt"></i>&ensp;Mathématiques
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapseTwo"
                  class="collapse"
                  aria-labelledby="headingTwo"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(5)"
                      data-toggle="collapse"
                      data-target="#collapseThree"
                      aria-expanded="false"
                      aria-controls="collapseThree"
                    >
                      <h4>
                        <i class="fas fa-square-root-alt"></i>&ensp;Mathématiques(FR)
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapseThree"
                  class="collapse"
                  aria-labelledby="headingThree"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading4">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      data-toggle="collapse"
                      data-target="#collapse4"
                      aria-expanded="false"
                      @click=" getCours(3)"
                      aria-controls="collapse4"
                    >
                      <h4>
                        <i class="fas fa-microscope"></i>&ensp;Physique et chimie
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse4"
                  class="collapse"
                  aria-labelledby="heading4"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading5">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      data-toggle="collapse"
                      data-target="#colapse5"
                      aria-expanded="false"
                      @click=" getCours(4)"
                      aria-controls="colapse5"
                    >
                      <h4>
                        <i class="fas fa-microscope"></i>&ensp;Physique et chimie(FR)
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="colapse5"
                  class="collapse"
                  aria-labelledby="heading5"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading6">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(6)"
                      data-toggle="collapse"
                      data-target="#collapse6"
                      aria-expanded="false"
                      aria-controls="collapse6"
                    >
                      <h4>
                        <i class="fas fa-seedling"></i>&ensp;sciences de la vie et de la terre(SVT)
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse6"
                  class="collapse"
                  aria-labelledby="heading6"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading7">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(7)"
                      data-toggle="collapse"
                      data-target="#collapse7"
                      aria-expanded="false"
                      aria-controls="collapse7"
                    >
                      <h4>
                        <i class="fas fa-seedling"></i>&ensp;sciences de la vie et de la terre(SVT FR)
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse7"
                  class="collapse"
                  aria-labelledby="heading7"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading8">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(8)"
                      data-toggle="collapse"
                      data-target="#collapse8"
                      aria-expanded="false"
                      aria-controls="collapse8"
                    >
                      <h4>
                        <i class="fas fa-language"></i>&ensp;Arabe
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse8"
                  class="collapse"
                  aria-labelledby="heading8"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading9">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(9)"
                      data-toggle="collapse"
                      data-target="#collapse9"
                      aria-expanded="false"
                      aria-controls="collapse9"
                    >
                      <h4>
                        <i class="fas fa-language"></i>&ensp;Français
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse9"
                  class="collapse"
                  aria-labelledby="heading9"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading10">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(10)"
                      data-toggle="collapse"
                      data-target="#collapse10"
                      aria-expanded="false"
                      aria-controls="collapse10"
                    >
                      <h4>
                        <i class="fas fa-language"></i>&ensp;Anglais
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse10"
                  class="collapse"
                  aria-labelledby="heading10"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading11">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(11)"
                      data-toggle="collapse"
                      data-target="#collapse11"
                      aria-expanded="false"
                      aria-controls="collapse11"
                    >
                      <h4>
                        <i class="fas fa-globe-africa"></i>&ensp;Histoire géographie
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse11"
                  class="collapse"
                  aria-labelledby="heading11"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading12">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      @click=" getCours(12)"
                      data-toggle="collapse"
                      data-target="#collapse12"
                      aria-expanded="false"
                      aria-controls="collapse12"
                    >
                      <h4>
                        <i class="fas fa-star-and-crescent"></i>&ensp;Education islamique
                      </h4>
                    </button>
                  </h2>
                </div>
                <div
                  id="collapse12"
                  class="collapse"
                  aria-labelledby="heading12"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        class="table table-bordered verticle-middle table-responsive-sm"
                        style="color:black;color:black"
                      >
                        <thead></thead>
                        <tbody>
                          <tr v-for="(item,index) in AllCoursesSubject" :key="index">
                            <td>
                              <a target="_blank" :href="'/'+item.fileCourse">
                                <h4>{{ item.nameCourse }}</h4>
                              </a>
                              <p v-for="(item2,index2) in AllExercices" :key="index2">
                                <span v-if="item2.course_id==item.id">
                                  <a target="_blank" :href="'/'+item2.fileExercice">
                                    <h6>
                                      <i class="fas fa-folder"></i>
                                      &ensp;{{ item2.nameExercice }}
                                    </h6>
                                  </a>
                                </span>
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <div
                              v-if="MsgError"
                              class="alert alert-danger"
                              role="alert"
                            >Aucun cours!</div>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card h-50 w-50 fixed">
              <div class="card-header">
                <h5>
                  <i class="fas fa-folder"></i>
                  &ensp;Les exercices
                </h5>
              </div>
              <div class="card-body ex1">
                <p v-for="(item2,index2) in AllExercices" :key="index2">
                  <a target="_blank" :href="'/'+item2.fileExercice">
                    <h6>
                      <i class="fas fa-file-pdf"></i>
                      &ensp;{{ item2.nameExercice }}
                    </h6>
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.fixed {
  position: fixed;
  top: 10;
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
      AllCoursesSubject: [],
      AllExercices: [],
      MsgError: false,
      Cycles: []
    };
  },
  methods: {
    getCours(idSubject) {
      axios.get("/StudentSubjectCourses/" + idSubject).then(response => {
        if (response.data["status"] == "success") {
          this.MsgError = false;
          this.AllCoursesSubject = response.data["student_subject_courses"];
          this.AllExercices = response.data["exercices"];
          if (this.AllCoursesSubject.length == 0) {
            this.MsgError = true;
            // alert("ok");
          }
        }
      });
    },
    getCycle() {
      axios.get("/get/cycle").then(response => {
        if (response.data["status"] == "success") {
          this.Cycles = response.data["timetable"];
        }
      });
    }
  },
  created() {
    this.getCycle();
    this.getCours(2);
  }
};
</script>