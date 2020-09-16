import * as colorConvert from 'color-convert';

export default function updateColors(primaryColor, secondaryColor, darkMode, coloredHeader) {

  // SaSS mix() function
  // it only accepts 6-digit hex values
  // do not use "#" char in hex codes
  // it also returns without "#" char
  // https://gist.github.com/jedfoster/7939513 (modified)
  var mix = function(color_1, color_2, weight) {
    function d2h(d) {
      return d.toString(16);
    } // convert a decimal value to hex
    function h2d(h) {
      return parseInt(h, 16);
    } // convert a hex value to decimal

    weight = (typeof(weight) !== 'undefined') ? weight : 50; // set the weight to 50%, if that argument is omitted

    var color = "";

    for (var i = 0; i <= 5; i += 2) { // loop through each of the 3 hex pairs—red, green, and blue
      var v1 = h2d(color_1.substr(i, 2)), // extract the current pairs
        v2 = h2d(color_2.substr(i, 2)),

        // combine the current pairs from each source color, according to the specified weight
        val = d2h(Math.floor(v2 + (v1 - v2) * (weight / 100.0)));

      while (val.length < 2) {
        val = '0' + val;
      } // prepend a '0' if val results in a single digit

      color += val; // concatenate val to our new color string
    }

    return color; // PROFIT!
  };

  var colors = {};

  const normalizedPrimary = colorConvert.rgb.hex(colorConvert.hex.rgb(primaryColor));
  const normalizedSecondary = colorConvert.rgb.hex(colorConvert.hex.rgb(secondaryColor));

  colors.primaryColor = normalizedPrimary;
  colors.secondaryColor = normalizedSecondary;

  const primaryHsl = colorConvert.hex.hsl(colors.primaryColor);
  const secondaryHsl = colorConvert.hex.hsl(colors.secondaryColor);

  if (darkMode) {
    colors.bodyBg = colorConvert.hsl.hex(secondaryHsl[0], Math.min(20, secondaryHsl[1]), 10);
    colors.textColor = 'DDDDDD';
    colors.mutedColor = colorConvert.hsl.hex(secondaryHsl[0], Math.min(15, secondaryHsl[1]), 50);
    colors.mutedMoreColor = colorConvert.hsl.hex(secondaryHsl[0], Math.min(10, secondaryHsl[1]), 40);
    colors.controlBg = colorConvert.hsl.hex(secondaryHsl[0], Math.min(20, secondaryHsl[1]), 13);
  } else {
    colors.bodyBg = 'FFFFFF';
    colors.textColor = '111111';
    colors.mutedColor = colorConvert.hsl.hex(secondaryHsl[0], Math.min(20, secondaryHsl[1]), 50);
    colors.mutedMoreColor = 'AAAAAA';
    colors.controlBg = colorConvert.hsl.hex(secondaryHsl[0], Math.min(50, secondaryHsl[1]), 93);
  }

  colors.headingColor = colors.textColor;
  colors.controlColor = colors.mutedColor;
  colors.linkColor = colorConvert.hsl.hex(
    primaryHsl[0],
    primaryHsl[1] + 10 > 100 ? 100 : primaryHsl[1] + 10,
    primaryHsl[2]
  );

  if (coloredHeader) {
    colors.headerBg = normalizedPrimary;
    colors.headerColor = colors.bodyBg;
    colors.headerControlBg = mix('000000', colors.headerBg, 10);
    colors.headerControlColor = mix(colors.bodyBg, colors.headerBg, 60);
  } else {
    colors.headerBg = colors.bodyBg;
    colors.headerColor = normalizedPrimary;
    colors.headerControlBg = colors.controlBg;
    colors.headerControlColor = colors.controlColor;
  }

  colors.heroBg = colors.controlBg;
  colors.heroColor = colors.controlColor;

  colors.highlightedDiscussion = mix(colors.controlBg, colors.bodyBg, 50);
  colors.discussionTitleColor = mix(colors.headingColor, colors.bodyBg, 55);

  const controlBgHsl = colorConvert.hex.hsl(colors.controlBg);
  colors.notificationDarkerBg = colorConvert.hsl.hex(
    controlBgHsl[0],
    controlBgHsl[1],
    controlBgHsl[2] - 5 < 0 ? 0 : controlBgHsl[2] - 5
  );

  return colors;
}
