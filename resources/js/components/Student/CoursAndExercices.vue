<template>
  <div>
    <div class="card">
      <div class="card-body text-center">
        <div class="row">
          <div class="col-lg-12">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left"
                      type="button"
                      @click="getCoursMath"
                      data-toggle="collapse"
                      data-target="#collapseOne"
                      aria-expanded="true"
                      aria-controls="collapseOne"
                    >informatique</button>
                  </h2>
                </div>

                <div
                  id="collapseOne"
                  class="collapse show"
                  aria-labelledby="headingOne"
                  data-parent="#accordionExample"
                >
                  <div class="card-body">
                    <div class="card" style="width: 18rem;">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">exercice 1</li>
                        <li class="list-group-item">exercice 2</li>
                        <li class="list-group-item">exercice 3</li>
                      </ul>
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
                      data-toggle="collapse"
                      data-target="#collapseTwo"
                      aria-expanded="false"
                      aria-controls="collapseTwo"
                    >Collapsible Group Item #2</button>
                  </h2>
                </div>
                <div
                  id="collapseTwo"
                  class="collapse"
                  aria-labelledby="headingTwo"
                  data-parent="#accordionExample"
                >
                  <div
                    class="card-body"
                  >Some placeholder content for the second accordion panel. This panel is hidden by default.</div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button
                      class="btn btn-link btn-block text-left collapsed"
                      type="button"
                      data-toggle="collapse"
                      data-target="#collapseThree"
                      aria-expanded="false"
                      aria-controls="collapseThree"
                    >Collapsible Group Item #3</button>
                  </h2>
                </div>
                <div
                  id="collapseThree"
                  class="collapse"
                  aria-labelledby="headingThree"
                  data-parent="#accordionExample"
                >
                  <div
                    class="card-body"
                  >And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.</div>
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
      CoursExercicesMath: []
    };
  },
  methods: {
    getCoursMath() {
      axios.get("/cours/exercices").then(response => {});
    }
  }
};
</script>