export default {
  install (Vue) {
    Vue.filter('BRL', value => value.toLocaleString('pt-br', {
      style: 'currency',
      currency: 'BRL',
    }));

    Vue.filter('truncate', (string, at = 30) => string.length <= at ? string : string.substring(0, at - 3).trim() + '...');
  },
};
