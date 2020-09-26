import { shallowMount } from '@vue/test-utils';
import ZFiltersEvents from './ZFiltersEvents.vue';

describe('ZFiltersEvents.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZFiltersEvents);
    expect(component.get('.z-filters-events'));
  });
});
