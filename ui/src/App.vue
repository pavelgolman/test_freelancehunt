<template>
  <Loader :loading="showLoader" />
  <Error v-if="error" v-bind:message="error" />
  <table width="100%" cellspacing="0" cellpadding="0" v-if="!showLoader && !error">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>
          <input type="text" v-model="searchName" class="search-name" placeholder="Name" />
        </th>
        <th>Skills</th>
        <th align="left">
          <input type="number" v-model="searchBudget" class="search-budget" placeholder="Budget" />
        </th>
      </tr>
    </thead>
    <tbody>
      <Project v-for="project in filteredProjects" :project="project" :key="project.id" />
    </tbody>
    <tfoot>
      <tr>
        <td align="center">
          <b v-if="prev && !isSearch()" v-on:click="change(prev)">
            Prev
          </b>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
          <b v-if="next && !isSearch()" v-on:click="change(next)">
            Next
          </b>
        </td>
      </tr>
    </tfoot>
  </table>
</template>

<script lang="ts">
  import axios from 'axios'
  import Project from './components/Project.vue'
  import Loader from './components/Loader.vue'
  import Error from './components/Error.vue'

  export default {
    components: {
      Loader,
      Project,
      Error
    },
    data () {
      return {
        showLoader: false,
        error: null,
        projects: [],
        filteredProjects: [],
        current: '/projects',
        next: null,
        prev: null,
        searchName: '',
        searchBudget: 0
      }
   },
   created () {
     this.loadProjects()
   },
   watch: {
     searchName: {
       handler: function(newSearch, oldSearch){
         this.filter()
       }
     },
     searchBudget: {
       handler: function(newSearch, oldSearch){
         this.filter()
       }
     },
   },
   methods: {
     change(url){
       this.current = url
       this.loadProjects()
     },
     isSearch(){
       return !!this.searchName || !!this.searchBudget
     },
     filter(){
       console.log(this.searchBudget, this.searchName)
       this.filteredProjects =
          this.projects.filter(p =>
            (p.attributes.name.includes(this.searchName)
              || p.attributes.description.includes(this.searchName))
              && (!this.searchBudget || (p.attributes.budget?.amount || 0) > parseFloat(this.searchBudget))
          )
     },
     loadProjects() {
       this.showLoader = true
       axios.get(`${import.meta.env.VITE_API_HOST}${this.current}`)
         .then(response => {
           this.showLoader = false
           if(response.data.data && response.data.links){
             this.projects = response.data.data
             this.filteredProjects = this.projects
             this.next = response.data.links.next
             this.prev = response.data.links.prev
           }else{
             this.error = 'Incorrect server response'
           }
         }).catch(error => {
           this.showLoader = false
           this.error = error.message
         })
     },
    onChangeCurrent (current) {
      this.current = current
      this.loadProjects()
    }
  }
  }

</script>
