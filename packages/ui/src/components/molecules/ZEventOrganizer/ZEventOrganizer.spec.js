import { shallowMount } from '@vue/test-utils';
import ZEventOrganizer from './ZEventOrganizer.vue';

describe('ZEventOrganizer.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZEventOrganizer);
    expect(component.get('.z-event-organizer'));
  });
});
