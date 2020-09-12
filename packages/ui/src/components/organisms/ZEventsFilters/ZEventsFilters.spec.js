import { shallowMount } from "@vue/test-utils";
import ZEventsFilters from "./ZEventsFilters.vue";
describe("ZEventsFilters.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZEventsFilters);
    expect(component.get(".z-events-filters"));
  });
});
