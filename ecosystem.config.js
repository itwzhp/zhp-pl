module.exports = {
  apps: [
    {
      name: 'nowa-zhp',
      exec_mode: 'cluster',
      instances: 'max',
      script: './node_modules/nuxt/bin/nuxt.js',
      args: 'start',
    },
  ],
};
