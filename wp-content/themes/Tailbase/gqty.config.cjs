/**
 * @type {import("@gqty/cli").GQtyConfig}
 */
const config = {
  react: true,
  scalarTypes: { DateTime: "string" },
  introspection: {
    endpoint: "http://juliananovello.local/graphql",
    headers: {},
  },
  destination: "./resources/assets/js/gqty/index.ts",
  subscriptions: false,
  javascriptOutput: false,
};

module.exports = config;
