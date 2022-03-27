<template>
  <div>
    <a :href="logo" class="pjax"><img height="40px" width="100px" id="logo" :src="logo" alt="khana"/></a>
  </div>
</template>
<script>
export default {
  props:[
    'logo'
  ]
}
</script>