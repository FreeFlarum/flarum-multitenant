export default function insertAfter(newNode: HTMLElement, referenceNode: Element) {
  if (!referenceNode.parentNode) return;
  return referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
