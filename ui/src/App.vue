<template>
  <Loader :loading="showLoader" />
  <table width="100%" cellspacing="0" cellpadding="0" v-if="!showLoader">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Name</th>
        <th>Skills</th>
        <th>Budget</th>
      </tr>
    </thead>
    <tbody>
      <Project v-for="project in projects" :project="project" :key="project.id" />
    </tbody>
    <tfoot>
      <tr>
        <td align="center">
          <b v-if="prev" v-on:click="change(prev)">
            Prev
          </b>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
          <b v-if="next" v-on:click="change(next)">
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

  export default {
    components: {
      Loader,
      Project
    },
    data () {
      return {
        showLoader: false,
        projects: [],
        current: '/projects',
        next: null,
        prev: null,
      }
   },
   created () {
     this.loadProjects()
   },
   methods: {
     change(url){
       this.current = url
       this.loadProjects()
     },
     loadProjects() {
       this.showLoader = true
       axios.get(`${import.meta.env.VITE_API_HOST}${this.current}`)
         .then(response => {
           console.log('response', response)
           this.showLoader = false
           this.projects = response.data.data
           this.next = response.data.links.next
           this.prev = response.data.links.prev
          })
        },
        onChangeCurrent (current) {
          this.current = current
          this.loadProjects()
        },
      }
    }

</script>
