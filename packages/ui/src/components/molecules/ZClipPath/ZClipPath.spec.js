import { shallowMount } from "@vue/test-utils";
import ZClipPath from "./ZClipPath.vue";
describe("ZClipPath.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZClipPath);
    expect(component.get(".z-clip-path"));
  });
});
