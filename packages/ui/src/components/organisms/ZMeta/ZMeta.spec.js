import { shallowMount } from "@vue/test-utils";
import ZMeta from "./ZMeta.vue";
describe("ZMeta.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZMeta);
    expect(component.get(".z-meta"));
  });
});
