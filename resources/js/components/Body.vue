<template>
  <div id="body" style="margin-top:5px">
    <LeftBody />
    <RightBody />
  </div>
</template>

<script>
import LeftBody from './LeftBody';
import RightBody from './RightBody';
export default {
  components: {
    LeftBody,
    RightBody,
  },
};
</script>