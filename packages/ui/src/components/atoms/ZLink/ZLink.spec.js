import { shallowMount } from "@vue/test-utils";
import ZLink from "./ZLink.vue";
describe("ZLink.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZLink);
    expect(component.contains(".z-link")).toBe(true);
  });
});
