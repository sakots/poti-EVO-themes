/* Check for native pointer event support before PEP adds its polyfill */
if (window.PointerEvent) {
    window.hasNativePointerEvents = true;
}
