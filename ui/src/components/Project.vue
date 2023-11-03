<template>
  <tr v-on:click="toggle()" style="cursor: pointer;">
    <td>
     {{ expanded ? 'ᐯ' : 'ᐳ' }}
    </td>
    <td>
        {{ project.attributes?.name }}
    </td>
    <td>
        {{ project.attributes?.skills.map(s => s.name).join(', ') }}
    </td>
    <td>
        {{ project.attributes?.budget?.amount }} {{ project.attributes?.budget?.currency }}
    </td>
  </tr>
  <tr v-if="expanded" class="expanded">
    <td colspan="3">
      <a v-bind:href="project.links.self.web" target="_blank">{{ project.links.self.web }}</a>
    </td>
    <td>
      {{ (new Date(project.attributes?.published_at)).toLocaleString() }}
    </td>
  </tr>
  <tr v-if="expanded" class="expanded">
    <td colspan="4" v-html="project.attributes.description_html">

    </td>
  </tr>
</template>

<script>
export default {
  name: 'project',
  props: {
    project: Object
  },
  data () {
    return {
      expanded: false
    }
  },
  methods: {
    toggle(){
      this.expanded = !this.expanded
    }
  }
}
</script>
