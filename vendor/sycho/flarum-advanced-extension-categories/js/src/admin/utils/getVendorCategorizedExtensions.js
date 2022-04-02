export default function getVendorCategorizedExtensions() {
  let extensions = {};

  Object.keys(app.data.extensions).map((id) => {
    const vendor = id.split('-')[0];

    extensions[vendor] = extensions[vendor] || [];
    extensions[vendor].push(app.data.extensions[id]);
  });

  return extensions;
}
