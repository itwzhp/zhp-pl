import { shallowMount } from "@vue/test-utils";
import ZSearch from "./ZSearch.vue";
describe("ZSearch.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZSearch);
    expect(component.get(".z-search"));
  });
});
