// Not sure how this works, but removing from tailwind.config seems to lose dynamic styles

module.exports = {
  whitelist: [],
  whitelistPatterns: [
      /^p-/,
      /^pt-/,
      /^pb-/,
      /^pr-/,
      /^pl-/,
      /^m-/,
      /^mt-/,
      /^mb-/,
      /^ml-/,
      /^mr-/,
  ],
  whitelistPatternsChildren: []
}
